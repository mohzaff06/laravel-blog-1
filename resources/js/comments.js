import { showToast } from './toast.js';

function addComment(commentHtml) {
    const commentsContainer = document.getElementById('comments-container');
    commentsContainer.innerHTML += commentHtml;
}

function removeComment(commentId) {
    const comment = document.querySelector(`div[data-comment-id="${commentId}"]`);
    console.log(comment);
    comment.remove();
}







async function createComment() {
    const comment = document.getElementById('comment-input').value;
    const postId = location.pathname.split('/')[2];
    let res = await fetch(`/api/post/${postId}/create`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            post_id: postId,
            content: comment,
        }),
        credentials: 'include'
    });
    res = await res.json();
    if (res.type === 'success') {
        addComment(res.html);
    }
    showToast(res.type, res.message);

}


async function deleteComment(commentId) {
    let res = await fetch(`/api/comment/${commentId}`, {
        method: 'DELETE',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        credentials: 'include'
    });
    console.log(res);
    res = await res.json();
    if (res.type === 'success') {
        removeComment(commentId);
    }
    showToast(res.type, res.message);

}

async function updateComment(commentId, newText) {
    try {
        const res = await fetch(`/api/comment/${commentId}`, {
            method: 'PUT',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ body: newText }),
            credentials: 'include'

        });

        console.log('Response status:', res.status);
        console.log('Response headers:', res.headers);

        if (!res.ok) {
            const errorData = await res.json().catch(() => ({}));
            throw new Error(`Failed to update comment: ${res.status} ${res.statusText} - ${errorData.message || ''}`);
        }

        const data = await res.json();
        console.log('Response data:', data);

        const commentContainer = document.querySelector(`div[data-comment-id='${commentId}']`);
        const commentBodyElement = commentContainer.querySelector('.comment-body');
        const commentBtns = commentContainer.querySelector('.comment-btns');

        commentBodyElement.textContent = data.comment;
        commentBodyElement.classList.remove('hidden');
        commentBtns.classList.remove('hidden');

        // Remove the edit form if open
        if (activeEditForm) {
            activeEditForm.element.remove();
            activeEditForm = null;
        }

        showToast('success', 'Comment updated successfully!');

    } catch (error) {
        console.error('Update comment error:', error);
        showToast('error', 'Failed to update comment.');
    }
}


let activeEditForm = null;
async function editComment(commentId) {
    const commentContainer = document.querySelector(`div[data-comment-id='${commentId}']`);
    const commentBodyElement = commentContainer.querySelector('.comment-body');
    const commentBtns = commentContainer.querySelector('.comment-btns');

    if (activeEditForm) {
        activeEditForm.cancel();
    }


    const currentText = commentBodyElement.textContent.trim();

    const editCommentForm = document.createElement('div');
    editCommentForm.innerHTML = `
        <div class="flex gap-4 justify-around items-center md:flex-nowrap flex-wrap">
            <div class="w-full">
                <div>
                    <input class="update-comment-input rounded-md px-4 py-2 border-black/25 border-1 w-full h-12 comment-update-input" name="comment" value='${currentText}' type="text" height="12" placeholder="Edit Comment">
                </div>
            </div>
            <button class="update-comment-button transition duration-300 cursor-pointer text-bg-primary px-3 py-1 font-semibold rounded-full bg-primary hover:bg-primary-hover h-8 items-center flex w-[5rem]">
                Update
            </button>
            <button class="cancel-comment-button transition duration-300 cursor-pointer text-bg-primary px-3 py-1 font-semibold rounded-full bg-danger hover:bg-danger-hover h-8 items-center flex w-[5rem]">
                Cancel
            </button>
        </div>`;

    commentBtns.classList.add('hidden');
    commentBodyElement.classList.add('hidden');
    commentContainer.appendChild(editCommentForm);

    const cancelCommentBtn = editCommentForm.querySelector('.cancel-comment-button');
    const cancel = () => {
        commentBtns.classList.remove('hidden');
        commentBodyElement.classList.remove('hidden');
        editCommentForm.remove();
        activeEditForm = null;
    };
    cancelCommentBtn.addEventListener('click', cancel);

    activeEditForm = { element: editCommentForm, cancel };


    const commentInput = editCommentForm.querySelector(`input.update-comment-input`);
    const updateCommentBtn = editCommentForm.querySelector(`button.update-comment-button`);
    updateCommentBtn.addEventListener('click', () => {
        const newText = commentInput.value.trim();
        if (newText.length === 0) {
            showToast('bg-yellow-500 text-white', 'Comment cannot be empty.');
            return;
        }
        updateComment(commentId, newText);
    });
}





document.addEventListener('DOMContentLoaded', () => {

    if(location.pathname.startsWith('/post/')) {
        const createCommentBtn = document.getElementById('create-comment-btn');
        createCommentBtn.addEventListener('click', (e) => {
            e.preventDefault();
            createComment();
        })

        const commentContainer = document.getElementById('comments-container');
        commentContainer.addEventListener('click', (e) => {
            if (e.target && e.target.classList.contains('delete-comment-btn')) {
                const commentId = e.target.dataset.commentId;
                deleteComment(commentId);
            } else if (e.target && e.target.classList.contains('edit-comment-btn')) {
                const commentId = e.target.dataset.commentId;
                editComment(commentId);
            }
        });
    }


})
