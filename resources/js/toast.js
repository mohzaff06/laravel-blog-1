
export function showToast(type,message){
    const div = document.createElement('div');
    div.className = 'fixed inset-0 text-sm z-50 flex justify-center items-end mb-6 pointer-events-none ';
    div.innerHTML = `
    <div class="px-6 py-3 rounded-full shadow-lg  pointer-events-auto ${type}">
        ${message}
    </div>
    `;
    document.body.appendChild(div);
    setTimeout(()=>div.remove(), 4000)
}



