
export function salvarFormulario(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    Array.from(form.elements).forEach(el => {
        const id = el.id || el.name;
        if (!id) return;

        const ignorar = ['estoque' , 'checkboxFeminina']; // lista de IDs que não quer salvar

        if (!id || ignorar.includes(id)) return; // pula se estiver na lista
        // NÃO salva se o input numeracao_f for 40
        if (id === 'numeracao_f' && Number(el.value) === 40) return;

        if (el.type === "radio" || el.type === "checkbox") {

            localStorage.setItem(id, el.checked);
        } 
        else if (el.tagName === "SELECT") {
            // salva o índice da option selecionada
            localStorage.setItem(id, el.selectedIndex);
        } 
        else if (
            el.tagName === "TEXTAREA" ||
            ["text", "number", "date", "email"].includes(el.type)
        ) 
        {
            localStorage.setItem(id, el.value);
        }
    });
}



export function restaurarFormulario(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    Array.from(form.elements).forEach(el => {
        const id = el.id || el.name;
        if (!id) return;

        const saved = localStorage.getItem(id);
        if (saved !== null) {
            if (el.type === "radio" || el.type === "checkbox") {
                el.checked = saved === "true";
            } else if (el.tagName === "SELECT") {
                // setar a option pelo índice salvo
                el.selectedIndex = parseInt(saved, 10);
            } else {
                el.value = saved;
            }
        }
    });
}



export function limparFormularioDoLocalStorage(formId) {
    const form = document.getElementById(formId);
    if (!form) return;

    Array.from(form.elements).forEach(el => {
        const id = el.id || el.name;
        if (!id) return;

        localStorage.removeItem(id);
    });
}