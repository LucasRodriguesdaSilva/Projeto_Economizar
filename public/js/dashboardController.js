const salvarDados = () => {
    const tipo = document.querySelector('#tipo').value;
    const banco = document.querySelector('#banco').value;
    const descricao = document.querySelector('#descricao').value;
    const valor = document.querySelector('#valor').value;
    const data = document.querySelector('#data').value;

    console.log(typeof tipo, typeof banco, typeof valor, typeof descricao);
    console.log(tipo, banco, valor, descricao)
}