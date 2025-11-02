<?php
/**
 * Plugin Name: Envelope de Contribuição
 * Description: Calculadora digital para contribuições da Igreja Batista Vida só em Jesus
 * Version: 1.0.6
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
        .btn-pix { width: 100%; padding: 10px; background-color: #00a884; color: white; border: none; border-radius: 6px; font-size: 0.9em; font-weight: 600; cursor: pointer; margin-top: 15px; transition: background-color 0.2s; }
        .btn-pix:hover { background-color: #008c6f; }
        .btn-pix:active { transform: scale(0.98); }
        .pix-mensagem { background-color: #4caf50; color: white; padding: 10px; border-radius: 6px; text-align: center; font-weight: 600; margin-bottom: 10px; animation: fadeIn 0.3s; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
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
        @media (max-width: 768px) {
            .header-igreja { flex-direction: column; text-align: center; padding: 15px; }
            .logo-placeholder { margin-right: 0; margin-bottom: 10px; }
            .header-igreja h1 { font-size: 1.2em; }
            .corpo-calculadora { padding: 15px; }
            .campo-grupo { margin-bottom: 15px; }
            .campo-grupo label { font-size: 0.85em; }
            .campo-grupo label .versiculos { font-size: 0.75em; }
            .campo-total { padding: 15px; }
            .campo-total label { font-size: 0.95em; }
            .campo-total .valor-total { font-size: 2em; }
            .btn-pix { font-size: 0.85em; padding: 8px; }
            .acoes-container { flex-direction: column; gap: 8px; }
            .btn-acao { width: 100%; }
        }
        @media (max-width: 480px) {
            .header-igreja h1 { font-size: 1em; }
            .campo-grupo input[type="number"], .campo-grupo input[type="text"] { font-size: 1em; padding: 10px; }
            .input-com-simbolo input { padding-left: 40px !important; }
            .campo-total .valor-total { font-size: 1.8em; }
        }
    </style>
    <div class="container-envelope">
        <header class="header-igreja">
            <div class="logo-placeholder" style="background-image: url('http://ibacvsj.com.br/wp-content/uploads/2023/03/Logo_Internet.png');">
                <img id="logo-img" src="http://ibacvsj.com.br/wp-content/uploads/2023/03/Logo_Internet.png" alt="Logo" style="display:none;">
            </div>
            <h1 id="titulo-principal">Igreja Batista Vida só em Jesus</h1>
        </header>
        <main class="corpo-calculadora">
            <div class="campo-grupo">
                <label for="salario" id="label-remuneracao">Remuneração Mensal</label>
                <div class="input-com-simbolo">
                    <input type="text" id="salario" placeholder="Digite aqui sua remuneração">
                </div>
            </div>
            <div class="campo-total">
                <label for="total" id="label-total">Total da Contribuição</label>
                <p class="valor-total" id="total">R$ 0,00</p>
                <button class="btn-pix" id="btnPix">📋 Copiar Chave Pix</button>
            </div>
            <hr>
            <div class="campo-grupo">
                <label for="primicias" id="label-primicias">Primícias (1/30)<span class="versiculos" id="ref-primicias">Pv 3.9; Ez 44.30; Ml 3.10; Mt 23.23</span></label>
                <div class="input-com-simbolo"><input type="number" id="primicias" placeholder="0.00" min="0" step="0.01"></div>
            </div>
            <div class="campo-grupo">
                <label for="dizimo" id="label-dizimo">Dízimo (10%)<span class="versiculos" id="ref-dizimo">Gn 14.18-20; Lv 27.30-32; Ml 3.10-12</span></label>
                <div class="input-com-simbolo"><input type="number" id="dizimo" placeholder="0.00" min="0" step="0.01"></div>
            </div>
            <div class="campo-grupo">
                <label for="socorro" id="label-socorro">Oferta Minist. de Socorro (2%)<span class="versiculos" id="ref-socorro">Pv 22.9; Is 58.7-10; 1 Jo 3.17-18</span></label>
                <div class="input-com-simbolo"><input type="number" id="socorro" placeholder="0.00" min="0" step="0.01"></div>
            </div>
            <div class="campo-grupo">
                <label for="gratidao" id="label-gratidao">Oferta Gratidão (Voluntário c/ Propósito)<span class="versiculos" id="ref-gratidao">Êx 35.5; 1 Cr 29.9; 2 Co 9.7</span></label>
                <div class="input-com-simbolo"><input type="number" id="gratidao" placeholder="0.00" min="0" step="0.01"></div>
            </div>
            <div class="campo-grupo">
                <label for="semeadura" id="label-semeadura">Semeadura<span class="versiculos" id="ref-semeadura">2 Co 9.6-11; Gl 6.7-9</span></label>
                <div class="input-com-simbolo"><input type="number" id="semeadura" placeholder="0.00" min="0" step="0.01"></div>
            </div>
            <div class="campo-grupo">
                <label for="israel" id="label-israel">Oferta para Israel<span class="versiculos" id="ref-israel">Sl 122.6; Jo 4.22-23; Rm 11.16-18</span></label>
                <div class="input-com-simbolo"><input type="number" id="israel" placeholder="0.00" min="0" step="0.01"></div>
            </div>
            <button class="btn-limpar" id="btnLimpar" data-text-id="btn-limpar">Limpar</button>
            <div class="acoes-container">
                <button class="btn-acao btn-pdf" id="btnPDF" data-text-id="btn-pdf">📄 Gerar PDF</button>
                <button class="btn-acao btn-whatsapp" id="btnWhatsApp" data-text-id="btn-share">📱 Compartilhar</button>
            </div>
        </main>
    </div>
    <script>
        (function() {
            function gerarPDFComum() {
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
                const logoUrl = 'http://ibacvsj.com.br/wp-content/uploads/2023/03/Logo_Internet.png';
                const img = new Image();
                img.crossOrigin = 'Anonymous';
                img.src = logoUrl;
                try {
                    doc.addImage(img, 'PNG', 15, 10, 25, 25);
                } catch(e) {}
                doc.setFontSize(18);
                doc.text('ENVELOPE DE CONTRIBUICAO', 105, 20, { align: 'center' });
                doc.setFontSize(12);
                doc.text('Igreja Batista Vida so em Jesus', 105, 30, { align: 'center' });
                doc.setLineWidth(0.5);
                doc.line(20, 35, 190, 35);
                doc.setFontSize(11);
                doc.text('Remuneracao Mensal: R$ ' + salario, 20, 45);
                doc.setFontSize(11);
                doc.setFont(undefined, 'bold');
                doc.text('TOTAL DA CONTRIBUICAO:', 105, 58, { align: 'center' });
                doc.setFontSize(16);
                doc.text(total, 105, 68, { align: 'center' });
                doc.setFont(undefined, 'normal');
                doc.line(20, 75, 190, 75);
                doc.setFontSize(12);
                doc.setFont(undefined, 'bold');
                doc.text('DETALHAMENTO:', 20, 85);
                doc.setFont(undefined, 'normal');
                doc.setFontSize(11);
                let y = 95;
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
                return doc;
            }
            function aplicarMascara(valor) {
                valor = valor.replace(/\D/g, '');
                if (valor.length === 0) return '';
                if (valor.length <= 2) return valor.replace(/(\d{1,2})/, '$1');
                valor = valor.replace(/(\d+)(\d{2})$/, '$1,$2');
                return valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
            }
            function obterValorNumerico(valor) {
                if (!valor) return 0;
                return parseFloat(valor.replace(/\./g, '').replace(',', '.')) || 0;
            }
            function calcula() {
                const salario = obterValorNumerico(document.getElementById('salario').value);
                if (salario > 0) {
                    document.getElementById('primicias').value = Math.ceil(salario / 30).toFixed(2);
                    document.getElementById('dizimo').value = Math.ceil((salario - Math.ceil(salario / 30)) * 0.10).toFixed(2);
                    document.getElementById('socorro').value = Math.ceil(salario * 0.02).toFixed(2);
                    document.getElementById('gratidao').value = Math.ceil(salario * 0.001).toFixed(2);
                    document.getElementById('semeadura').value = Math.ceil(salario * 0.004).toFixed(2);
                    document.getElementById('israel').value = Math.ceil(salario * 0.01).toFixed(2);
                } else {
                    ['primicias', 'dizimo', 'socorro', 'gratidao', 'semeadura', 'israel'].forEach(id => document.getElementById(id).value = '');
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
                        e.target.value = aplicarMascara(e.target.value.replace(/\D/g, ''));
                        calcula();
                    });
                }
                ['primicias', 'dizimo', 'socorro', 'gratidao', 'semeadura', 'israel'].forEach(id => {
                    const el = document.getElementById(id);
                    if (el) el.addEventListener('input', calcularTotal);
                });
                const btnLimpar = document.getElementById('btnLimpar');
                if (btnLimpar) {
                    btnLimpar.addEventListener('click', function() {
                        document.getElementById('salario').value = '';
                        ['primicias', 'dizimo', 'socorro', 'gratidao', 'semeadura', 'israel'].forEach(id => document.getElementById(id).value = '');
                        document.getElementById('total').textContent = 'R$ 0,00';
                    });
                }
                const btnPDF = document.getElementById('btnPDF');
                if (btnPDF) {
                    btnPDF.addEventListener('click', function() {
                        if (typeof window.jspdf === 'undefined') { alert('Aguarde...'); return; }
                        gerarPDFComum().save('envelope-contribuicao.pdf');
                    });
                }
                const btnWhatsApp = document.getElementById('btnWhatsApp');
                if (btnWhatsApp) {
                    btnWhatsApp.addEventListener('click', function() {
                        if (typeof window.jspdf === 'undefined') { alert('Aguarde...'); return; }
                        const doc = gerarPDFComum();
                        const pdfBlob = doc.output('blob');
                        const pdfFile = new File([pdfBlob], 'envelope-contribuicao.pdf', { type: 'application/pdf' });
                        if (navigator.share && navigator.canShare && navigator.canShare({ files: [pdfFile] })) {
                            navigator.share({ title: 'Envelope de Contribuicao', files: [pdfFile] }).catch(() => doc.save('envelope-contribuicao.pdf'));
                        } else {
                            doc.save('envelope-contribuicao.pdf');
                        }
                    });
                }
                const btnPix = document.getElementById('btnPix');
                if (btnPix) {
                    btnPix.addEventListener('click', function() {
                        const chavePix = '05752842000113';
                        const campoTotal = document.querySelector('.campo-total');
                        
                        const input = document.createElement('input');
                        input.value = chavePix;
                        document.body.appendChild(input);
                        input.select();
                        input.setSelectionRange(0, 99999);
                        
                        try {
                            document.execCommand('copy');
                            document.body.removeChild(input);
                            
                            let mensagem = document.getElementById('pixMensagem');
                            if (!mensagem) {
                                mensagem = document.createElement('div');
                                mensagem.id = 'pixMensagem';
                                mensagem.className = 'pix-mensagem';
                                campoTotal.insertBefore(mensagem, btnPix);
                            }
                            mensagem.textContent = '✓ Pix CNPJ copiado com sucesso!';
                            mensagem.style.display = 'block';
                            
                            setTimeout(function() {
                                mensagem.style.display = 'none';
                            }, 5000);
                        } catch (err) {
                            document.body.removeChild(input);
                            alert('Chave Pix (CNPJ): 05752842000113');
                        }
                    });
                }
                calcula();
            }, 100);
        })();

        (function() {
            function obterValorNumerico(valor) {
                if (!valor) return 0;
                return parseFloat(valor.toString().replace(/\./g, '').replace(',', '.')) || 0;
            }

            function enviarDados(dados) {
                fetch('/wp-json/ibac/v1/log', {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(dados)
                }).catch(function() {});
            }

            setTimeout(function() {
                enviarDados({action: 'PAGE_VIEW', value: 0});
            }, 1000);

            setTimeout(function() {
                var salarioInput = document.getElementById('salario');
                if (salarioInput) {
                    salarioInput.addEventListener('blur', function() {
                        if (this.value) {
                            var valor = obterValorNumerico(this.value);
                            if (valor > 0) {
                                enviarDados({
                                    action: 'SALARIO_DIGITADO',
                                    value: valor
                                });
                            }
                        }
                    });
                }
            }, 1000);

            var calculaOriginal = window.calcula;
            window.calcula = function() {
                if (calculaOriginal) calculaOriginal();
                
                setTimeout(function() {
                    var salario = obterValorNumerico(document.getElementById('salario')?.value);
                    var primicias = obterValorNumerico(document.getElementById('primicias')?.value);
                    var dizimo = obterValorNumerico(document.getElementById('dizimo')?.value);
                    var socorro = obterValorNumerico(document.getElementById('socorro')?.value);
                    var gratidao = obterValorNumerico(document.getElementById('gratidao')?.value);
                    var semeadura = obterValorNumerico(document.getElementById('semeadura')?.value);
                    var israel = obterValorNumerico(document.getElementById('israel')?.value);
                    var total = obterValorNumerico(document.getElementById('total')?.textContent);

                    if (salario > 0) {
                        enviarDados({
                            action: 'CALCULO_COMPLETO',
                            value: total,
                            details: JSON.stringify({
                                salario: salario,
                                primicias: primicias,
                                dizimo: dizimo,
                                socorro: socorro,
                                gratidao: gratidao,
                                semeadura: semeadura,
                                israel: israel,
                                total: total
                            })
                        });
                    }
                }, 500);
            };

            setTimeout(function() {
                var campos = ['primicias', 'dizimo', 'socorro', 'gratidao', 'semeadura', 'israel'];
                
                campos.forEach(function(campoId) {
                    var campo = document.getElementById(campoId);
                    if (campo) {
                        campo.addEventListener('change', function() {
                            var valor = obterValorNumerico(this.value);
                            if (valor > 0) {
                                enviarDados({
                                    action: 'CAMPO_EDITADO',
                                    value: valor,
                                    details: JSON.stringify({campo: campoId, valor: valor})
                                });
                            }
                        });
                    }
                });
            }, 1500);

            setTimeout(function() {
                var totalElement = document.getElementById('total');
                if (totalElement) {
                    var observer = new MutationObserver(function(mutations) {
                        mutations.forEach(function(mutation) {
                            if (mutation.type === 'childList' || mutation.type === 'characterData') {
                                var total = obterValorNumerico(totalElement.textContent);
                                if (total > 0) {
                                    enviarDados({
                                        action: 'TOTAL_ATUALIZADO',
                                        value: total
                                    });
                                }
                            }
                        });
                    });
                    
                    observer.observe(totalElement, {
                        childList: true,
                        characterData: true,
                        subtree: true
                    });
                }
            }, 2000);

            setTimeout(function() {
                var btnLimpar = document.getElementById('btnLimpar');
                if (btnLimpar) {
                    btnLimpar.addEventListener('click', function() {
                        enviarDados({
                            action: 'FORMULARIO_LIMPO',
                            value: 0
                        });
                    });
                }
            }, 1500);

            setTimeout(function() {
                var btnPDF = document.getElementById('btnPDF');
                if (btnPDF) {
                    btnPDF.addEventListener('click', function() {
                        var total = obterValorNumerico(document.getElementById('total')?.textContent);
                        enviarDados({
                            action: 'PDF_GERADO',
                            value: total
                        });
                    });
                }
            }, 1500);

            setTimeout(function() {
                var btnWhatsApp = document.getElementById('btnWhatsApp');
                if (btnWhatsApp) {
                    btnWhatsApp.addEventListener('click', function() {
                        var total = obterValorNumerico(document.getElementById('total')?.textContent);
                        enviarDados({
                            action: 'WHATSAPP_COMPARTILHADO',
                            value: total
                        });
                    });
                }
            }, 1500);

        })();
    </script>

    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        
        // 1. Define a função para buscar e preencher os dados
        async function loadEnvelopeContent() {
            try {
                // Esta é a API que o seu plugin 'gestao-ibac-tributos.php' criou
                const response = await fetch('/wp-json/ibac/v1/content');
                if (!response.ok) {
                    throw new Error('Não foi possível carregar os dados.');
                }
                
                const data = await response.json();
                
                // 2. Mapeia os dados da API para os IDs do HTML
                // (Usamos 'data.key' para cada campo)
                const map = {
                    '#logo-img': { attr: 'src', key: data.logo },
                    '#titulo-principal': { text: data.site_title },
                    '#label-remuneracao': { text: data.label_remuneracao },
                    '#label-total': { text: data.label_total },
                    
                    '#label-primicias': { text: data.primicias_label },
                    '#ref-primicias': { text: data.ref_primicias },
                    
                    '#label-dizimo': { text: data.dizimo_label },
                    '#ref-dizimo': { text: data.ref_dizimo },
                    
                    '#label-socorro': { text: data.socorro_label },
                    '#ref-socorro': { text: data.ref_socorro },
                    
                    '#label-gratidao': { text: data.gratidao_label },
                    '#ref-gratidao': { text: data.ref_gratidao },
                    
                    '#label-semeadura': { text: data.semeadura_label },
                    '#ref-semeadura': { text: data.ref_semeadura },
                    
                    '#label-israel': { text: data.israel_label },
                    '#ref-israel': { text: data.ref_israel },
                    
                    '[data-text-id="btn-limpar"]': { text: data.label_btn_limpar },
                    '[data-text-id="btn-pdf"]': { text: data.label_btn_pdf },
                    '[data-text-id="btn-share"]': { text: data.label_btn_share },
                };
                
                // 3. Preenche o HTML
                for (const selector in map) {
                    const el = document.querySelector(selector);
                    const config = map[selector];
                    if (el) {
                        // Verifica se o valor da API não está vazio antes de substituir
                        if (config.text && config.text.trim() !== '') {
                            el.textContent = config.text;
                        }
                        if (config.attr && config.key && config.key.trim() !== '') {
                            el.setAttribute(config.attr, config.key);
                        }
                    }
                }

            } catch (error) {
                console.error('Erro ao carregar conteúdo dinâmico:', error);
            }
        }
        
        // 4. Inicia o carregamento
        loadEnvelopeContent();
    });
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('envelope_contribuicao', 'envelope_contribuicao_shortcode');
