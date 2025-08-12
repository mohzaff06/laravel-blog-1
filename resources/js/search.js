
















async function searchPosts(searchTerm) {
    try{
        let res = await fetch(`/api/post/search`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                q: searchTerm
            }),
            credentials: 'include'
        });

        if (!res.ok) {
            throw new Error(`Failed to search posts: ${res.status} ${res.statusText}`);
        }

        res = await res.json();

        if (res.status) {
            document.getElementById('posts-container').innerHTML = res.html;
        } else {
            document.getElementById('search-results').innerHTML = '';
        }
    }catch (e) {
        console.log('Error: ' + e);
    }
}








document.addEventListener('DOMContentLoaded', () => {

    if(location.pathname ==='/'){
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', (e) => {
            const searchTerm = e.target.value;
            searchPosts(searchTerm);
        });
    }
})
