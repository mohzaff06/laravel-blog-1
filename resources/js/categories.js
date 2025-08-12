import './toast.js';

function inactiveAllCategoryBtns(){
    document.querySelectorAll('.category-btn-active').forEach(btn => {
        btn.removeAttribute('disabled');
        btn.classList.remove('category-btn-active');
        btn.classList.add('cursor-pointer');
    })
}

function activeCategoryBtn(btn){
    btn.setAttribute('disabled', '');
    btn.classList.add('category-btn-active');
    btn.classList.remove('cursor-pointer');
}

function showPosts(html){
    document.getElementById('posts-container').innerHTML = html;
}









async function loadPostsByCategory(btn,category){
    let res = await fetch(`/api/category/${category}`,
        {
            headers: {
                'Content-Type': 'application/json',
            }
        });
    res = await res.json();
    if(!res.status){
        return;
    }
    inactiveAllCategoryBtns();
    activeCategoryBtn(btn);
    showPosts(res.html);
}

async function loadAllPosts(btn){
    let res = await fetch(`/api/category/all`,
        {
            headers: {
                'Content-Type': 'application/json',
            }
        });
    res = await res.json();
    if(!res.status){
        return;
    }
    inactiveAllCategoryBtns();
    activeCategoryBtn(btn);
    showPosts(res.html);
}









if(location.pathname === '/') {
    document.addEventListener('DOMContentLoaded', () => {
        const btn = document.getElementById('all-posts-btn');
        loadAllPosts(btn);
        const categoryBtns = document.querySelectorAll('.category-btn');
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', (e) => {
                if (btn.id === 'all-posts-btn') {
                    loadAllPosts(btn);
                } else {
                    loadPostsByCategory(btn, btn.dataset.categoryId);
                }
            })
        })
    })
}
