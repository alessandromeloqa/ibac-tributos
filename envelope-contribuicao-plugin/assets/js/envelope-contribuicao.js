function aplicarMascara(valor) {
    valor = valor.replace(/\D/g, '');
    if (valor.length === 0) return '';
    if (valor.length <= 2) return valor.replace(/(\d{1,2})/, '$1');
    valor = valor.replace(/(\d+)(\d{2})$/, '$1,$2');
    valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    return valor;
}

function obterValorNumerico(valor) {
    if (!valor) return 0;
    valor = valor.replace(/\./g, '').replace(',', '.');
    return parseFloat(valor) || 0;
}

function calcula() {
    const salario = obterValorNumerico(document.getElementById('salario').value);
    
    if (salario > 0) {
        const primicia = Math.ceil(salario / 30);
        document.getElementById('primicias').value = primicia.toFixed(2);
        
        const dizimo = Math.ceil((salario - primicia) * 0.10);
        document.getElementById('dizimo').value = dizimo.toFixed(2);
        
        document.getElementById('socorro').value = Math.ceil(salario * 0.02).toFixed(2);
        document.getElementById('gratidao').value = Math.ceil(salario * 0.001).toFixed(2);
        document.getElementById('semeadura').value = Math.ceil(salario * 0.004).toFixed(2);
        document.getElementById('israel').value = Math.ceil(salario * 0.01).toFixed(2);
    } else {
        ['primicias', 'dizimo', 'socorro', 'gratidao', 'semeadura', 'israel'].forEach(id => {
            document.getElementById(id).value = '';
        });
    }
    calcularTotal();
}

function calcularTotal() {
    const total = (parseFloat(document.getElementById('primicias').value) || 0) +
                 (parseFloat(document.getElementById('dizimo').value) || 0) +
                 (parseFloat(document.getElementById('socorro').value) || 0) +
                 (parseFloat(document.getElementById('gratidao').value) || 0) +
                 (parseFloat(document.getElementById('semeadura').value) || 0) +
                 (parseFloat(document.getElementById('israel').value) || 0);
    
    document.getElementById('total').textContent = total.toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
}

document.addEventListener('DOMContentLoaded', function() {
    const salarioInput = document.getElementById('salario');
    if (salarioInput) {
        salarioInput.addEventListener('input', function(e) {
            const valor = e.target.value.replace(/\D/g, '');
            e.target.value = aplicarMascara(valor);
            calcula();
        });
    }
    
    ['primicias', 'dizimo', 'socorro', 'gratidao', 'semeadura', 'israel'].forEach(id => {
        const element = document.getElementById(id);
        if (element) {
            element.addEventListener('input', calcularTotal);
        }
    });
    
    calcula();
});
