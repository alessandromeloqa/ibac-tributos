<?php
/**
 * Plugin Name: Envelope de Contribuição
 * Description: Calculadora digital para contribuições da Igreja Batista Vida só em Jesus
 * Version: 1.0.4
 * Author: Igreja Batista Vida só em Jesus
 */

if (!defined('ABSPATH')) exit;

function envelope_contribuicao_shortcode() {
    wp_enqueue_script('jspdf', 'https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js', array(), '2.5.1', true);
    ob_start();
    ?>
    <style>
        .container-envelope * { box-sizing: border-box; }
        .container-envelope { max-width: 600px; width: 100%; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border-top: 5px solid #38b6ff; overflow: hidden; margin: 20px auto; font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; }
        .header-igreja { display: flex; align-items: center; padding: 20px; background-color: #fdfdfd; border-bottom: 1px solid #ddd; }
        .logo-placeholder { width: 60px; height: 60px; background-color: #ddd; border-radius: 8px; margin-right: 15px; background-size: contain; background-repeat: no-repeat; background-position: center; display: flex; justify-content: center; align-items: center; font-weight: bold; color: #888; font-size: 12px; text-align: center; flex-shrink: 0; }
        .header-igreja h1 { font-size: 1.5em; color: #333; margin: 0; font-weight: 600; }
        .corpo-calculadora { padding: 25px; }
        .campo-grupo { margin-bottom: 20px; }
        .campo-grupo label { display: block; font-weight: 600; color: #333; margin-bottom: 8px; font-size: 0.9em; text-transform: uppercase; letter-spacing: 0.5px; }
        .campo-grupo label .versiculos { font-weight: 400; font-size: 0.85em; color: #777; text-transform: none; display: block; margin-top: 4px; }
        .campo-grupo input[type="number"], .campo-grupo input[type="text"] { width: 100%; padding: 12px; font-size: 1.1em; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; transition: border-color 0.2s, box-shadow 0.2s; }
        #salario { font-size: 0.95em; }
        .campo-grupo input[type="number"]:focus, .campo-grupo input[type="text"]:focus { border-color: #38b6ff; box-shadow: 0 0 0 3px rgba(56,182,255,0.2); outline: none; }
        .input-com-simbolo { position: relative; }
        .input-com-simbolo::before { content: "R$"; position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: #888; font-weight: 500; pointer-events: none; }
        .input-com-simbolo input { padding-left: 45px !important; font-weight: 500; }
        .corpo-calculadora hr { border: 0; border-top: 1px dashed #ddd; margin: 25px 0; }
        .campo-total { background-color: #f4f7f6; padding: 20px; border-radius: 8px; text-align: center; }
        .campo-total label { font-size: 1.1em; font-weight: 700; color: #38b6ff; text-transform: uppercase; letter-spacing: 1px; margin: 0; }
        .campo-total .valor-total { font-size: 2.5em; font-weight: 700; color: #333; margin: 10px 0 0 0; }
        .btn-limpar { width: 100%; padding: 12px; background-color: #ff6b6b; color: white; border: none; border-radius: 6px; font-size: 1em; font-weight: 600; cursor: pointer; transition: background-color 0.2s; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 10px; }
        .btn-limpar:hover { background-color: #ff5252; }
        .btn-limpar:active { transform: scale(0.98); }
        .acoes-container { display: flex; gap: 10px; margin-top: 20px; }
        .btn-acao { flex: 1; padding: 12px; border: none; border-radius: 6px; font-size: 0.95em; font-weight: 600; cursor: pointer; transition: all 0.2s; text-transform: uppercase; letter-spacing: 0.5px; }
        .btn-pdf { background-color: #e74c3c; color: white; }
        .btn-pdf:hover { background-color: #c0392b; }
        .btn-whatsapp { background-color: #25d366; color: white; }
        .btn-whatsapp:hover { background-color: #1da851; }
        .btn-acao:active { transform: scale(0.98); }
    </style>
    <div class="container-envelope">
        <header class="header-igreja">
            <div class="logo-placeholder" style="background-image: url('http://ibacvsj.com.br/wp-content/uploads/2023/03/Logo_Internet.png');"></div>
            <h1>Igreja Batista Vida só em Jesus</h1>
        </header>
        <main class="corpo-calculadora">
            <div class="campo-grupo">
                <label for="salario">Remuneração Mensal</label>
                <div class="input-com-simbolo">
                    <input type="text" id="salario" class="calculadora-input" placeholder="Digite aqui sua remuneração">
                </div>
            </div>
            <div class="campo-total">
                <label for="total">Total da Contribuição</label>
                <p class="valor-total" id="total">R$ 0,00</p>
            </div>
            <hr>
            <div class="campo-grupo">
                <label for="primicias">Primícias (1/30)<span class="versiculos">Pv 3.9; Ez 44.30; Ml 3.10; Mt 23.23</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="primicias" placeholder="0.00" min="0" step="0.01">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="dizimo">Dízimo (10%)<span class="versiculos">Gn 14.18-20; Lv 27.30-32; Ml 3.10-12</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="dizimo" placeholder="0.00" min="0" step="0.01">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="socorro">Oferta Minist. de Socorro (2%)<span class="versiculos">Pv 22.9; Is 58.7-10; 1 Jo 3.17-18</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="socorro" placeholder="0.00" min="0" step="0.01">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="gratidao">Oferta Gratidão (Voluntário c/ Propósito)<span class="versiculos">Êx 35.5; 1 Cr 29.9; 2 Co 9.7</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="gratidao" placeholder="0.00" min="0" step="0.01">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="semeadura">Semeadura<span class="versiculos">2 Co 9.6-11; Gl 6.7-9</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="semeadura" placeholder="0.00" min="0" step="0.01">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="israel">Oferta para Israel<span class="versiculos">Sl 122.6; Jo 4.22-23; Rm 11.16-18</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="israel" placeholder="0.00" min="0" step="0.01">
                </div>
            </div>
            <button class="btn-limpar" id="btnLimpar">Limpar</button>
            <div class="acoes-container">
                <button class="btn-acao btn-pdf" id="btnPDF">📄 Gerar PDF</button>
                <button class="btn-acao btn-whatsapp" id="btnWhatsApp">📱 Compartilhar</button>
            </div>
        </main>
    </div>
    <script>
        (function() {
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
            setTimeout(function() {
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
                    if (element) element.addEventListener('input', calcularTotal);
                });
                const btnLimpar = document.getElementById('btnLimpar');
                if (btnLimpar) {
                    btnLimpar.addEventListener('click', function() {
                        document.getElementById('salario').value = '';
                        ['primicias', 'dizimo', 'socorro', 'gratidao', 'semeadura', 'israel'].forEach(id => {
                            document.getElementById(id).value = '';
                        });
                        document.getElementById('total').textContent = 'R$ 0,00';
                    });
                }
                const btnPDF = document.getElementById('btnPDF');
                if (btnPDF) {
                    btnPDF.addEventListener('click', function() {
                        if (typeof window.jspdf === 'undefined') {
                            alert('Aguarde o carregamento da biblioteca PDF...');
                            return;
                        }
                        const { jsPDF } = window.jspdf;
                        const doc = new jsPDF();
                        const salario = document.getElementById('salario').value || '0';
                        const primicias = document.getElementById('primicias').value || '0.00';
                        const dizimo = document.getElementById('dizimo').value || '0.00';
                        const socorro = document.getElementById('socorro').value || '0.00';
                        const gratidao = document.getElementById('gratidao').value || '0.00';
                        const semeadura = document.getElementById('semeadura').value || '0.00';
                        const israel = document.getElementById('israel').value || '0.00';
                        const total = document.getElementById('total').textContent;
                        doc.setFontSize(18);
                        doc.text('ENVELOPE DE CONTRIBUICAO', 105, 20, { align: 'center' });
                        doc.setFontSize(12);
                        doc.text('Igreja Batista Vida so em Jesus', 105, 30, { align: 'center' });
                        doc.setLineWidth(0.5);
                        doc.line(20, 35, 190, 35);
                        doc.setFontSize(11);
                        doc.text('Remuneracao Mensal: R$ ' + salario, 20, 45);
                        doc.setFontSize(14);
                        doc.setFont(undefined, 'bold');
                        doc.text(total, 105, 55, { align: 'center' });
                        doc.setFont(undefined, 'normal');
                        doc.line(20, 60, 190, 60);
                        doc.setFontSize(12);
                        doc.setFont(undefined, 'bold');
                        doc.text('DETALHAMENTO:', 20, 70);
                        doc.setFont(undefined, 'normal');
                        doc.setFontSize(11);
                        let y = 80;
                        doc.text('Primicias (1/30): R$ ' + primicias, 20, y);
                        y += 10;
                        doc.text('Dizimo (10%): R$ ' + dizimo, 20, y);
                        y += 10;
                        doc.text('Oferta Socorro (2%): R$ ' + socorro, 20, y);
                        y += 10;
                        doc.text('Oferta Gratidao: R$ ' + gratidao, 20, y);
                        y += 10;
                        doc.text('Semeadura: R$ ' + semeadura, 20, y);
                        y += 10;
                        doc.text('Oferta Israel: R$ ' + israel, 20, y);
                        doc.line(20, y + 5, 190, y + 5);
                        doc.save('envelope-contribuicao.pdf');
                    });
                }
                const btnWhatsApp = document.getElementById('btnWhatsApp');
                if (btnWhatsApp) {
                    btnWhatsApp.addEventListener('click', function() {
                        const salario = document.getElementById('salario').value || '0';
                        const total = document.getElementById('total').textContent;
                        const primicias = document.getElementById('primicias').value || '0.00';
                        const dizimo = document.getElementById('dizimo').value || '0.00';
                        const socorro = document.getElementById('socorro').value || '0.00';
                        const gratidao = document.getElementById('gratidao').value || '0.00';
                        const semeadura = document.getElementById('semeadura').value || '0.00';
                        const israel = document.getElementById('israel').value || '0.00';
                        const mensagem = `*ENVELOPE DE CONTRIBUICAO*%0AIgreja Batista Vida so em Jesus%0A%0A================================%0A%0ARemuneracao: R$ ${salario}%0A%0A*${total}*%0A%0A================================%0A%0A*Detalhamento:*%0A%0APrimicias: R$ ${primicias}%0ADizimo: R$ ${dizimo}%0ASocorro: R$ ${socorro}%0AGratidao: R$ ${gratidao}%0ASemeadura: R$ ${semeadura}%0AIsrael: R$ ${israel}`;
                        if (navigator.share) {
                            navigator.share({ title: 'Envelope de Contribuicao', text: mensagem.replace(/%0A/g, '\n').replace(/\*/g, '') }).catch(() => { window.open(`https://wa.me/?text=${mensagem}`, '_blank'); });
                        } else {
                            window.open(`https://wa.me/?text=${mensagem}`, '_blank');
                        }
                    });
                }
                calcula();
            }, 100);
        })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('envelope_contribuicao', 'envelope_contribuicao_shortcode');
