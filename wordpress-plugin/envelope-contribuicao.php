<?php
/**
 * Plugin Name: Envelope de Contribuição
 * Description: Calculadora digital para contribuições da Igreja Batista Vida só em Jesus
 * Version: 1.0.2
 * Author: Igreja Batista Vida só em Jesus
 */

if (!defined('ABSPATH')) exit;

function envelope_contribuicao_shortcode() {
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
    </style>
    <div class="container-envelope">
        <header class="header-igreja">
            <div class="logo-placeholder">Sua Logo</div>
            <h1>Igreja Batista Vida só em Jesus</h1>
        </header>
        <main class="corpo-calculadora">
            <div class="campo-grupo">
                <label for="salario">Remuneração Mensal</label>
                <div class="input-com-simbolo">
                    <input type="text" id="salario" class="calculadora-input" placeholder="Digite aqui sua remuneração" aria-describedby="salario-desc">
                </div>
            </div>
            <hr>
            <div class="campo-grupo">
                <label for="primicias">Primícias<span class="versiculos" id="primicias-desc">Pv 3.9; Ez 44.30; Ml 3.10; Mt 23.23</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="primicias" class="calculadora-input campo-contribuicao" placeholder="0.00" min="0" step="0.01" aria-describedby="primicias-desc">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="dizimo">Dízimo<span class="versiculos" id="dizimo-desc">Gn 14.18-20; Lv 27.30-32; Ml 3.10-12</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="dizimo" class="calculadora-input campo-contribuicao" placeholder="0.00" min="0" step="0.01" aria-describedby="dizimo-desc">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="socorro">Oferta Minist. de Socorro<span class="versiculos" id="socorro-desc">Pv 22.9; Is 58.7-10; 1 Jo 3.17-18</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="socorro" class="calculadora-input campo-contribuicao" placeholder="0.00" min="0" step="0.01" aria-describedby="socorro-desc">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="gratidao">Oferta Gratidão (Voluntário c/ Propósito)<span class="versiculos" id="gratidao-desc">Êx 35.5; 1 Cr 29.9; 2 Co 9.7</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="gratidao" class="calculadora-input campo-contribuicao" placeholder="0.00" min="0" step="0.01" aria-describedby="gratidao-desc">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="semeadura">Semeadura<span class="versiculos" id="semeadura-desc">2 Co 9.6-11; Gl 6.7-9</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="semeadura" class="calculadora-input campo-contribuicao" placeholder="0.00" min="0" step="0.01" aria-describedby="semeadura-desc">
                </div>
            </div>
            <div class="campo-grupo">
                <label for="israel">Oferta para Israel<span class="versiculos" id="israel-desc">Sl 122.6; Jo 4.22-23; Rm 11.16-18</span></label>
                <div class="input-com-simbolo">
                    <input type="number" id="israel" class="calculadora-input campo-contribuicao" placeholder="0.00" min="0" step="0.01" aria-describedby="israel-desc">
                </div>
            </div>
            <div class="campo-total">
                <label for="total">Total da Contribuição</label>
                <p class="valor-total" id="total">R$ 0,00</p>
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
                calcula();
            }, 100);
        })();
    </script>
    <?php
    return ob_get_clean();
}
add_shortcode('envelope_contribuicao', 'envelope_contribuicao_shortcode');
