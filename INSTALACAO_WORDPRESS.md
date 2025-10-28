# 📦 Guia de Instalação - WordPress/Hostinger

## 🚀 Passo a Passo Rápido

### 1️⃣ Preparar o Plugin

**Opção A: Compactar manualmente**
- Vá até a pasta `wordpress-plugin`
- Selecione TODOS os arquivos dentro dela
- Clique com botão direito → Enviar para → Pasta compactada
- Renomeie para `envelope-contribuicao.zip`

**Opção B: Usar linha de comando**
```bash
cd wordpress-plugin
zip -r envelope-contribuicao.zip *
```

### 2️⃣ Instalar no WordPress

**Via Painel WordPress (Mais Fácil):**

1. Acesse: `seusite.com/wp-admin`
2. Menu lateral: **Plugins** → **Adicionar novo**
3. Clique no botão **Enviar plugin** (topo da página)
4. Clique em **Escolher arquivo**
5. Selecione `envelope-contribuicao.zip`
6. Clique em **Instalar agora**
7. Aguarde a instalação
8. Clique em **Ativar plugin**

**Via FTP/Hostinger:**

1. Acesse o painel da Hostinger
2. Vá em **Arquivos** → **Gerenciador de Arquivos**
3. Navegue até: `public_html/wp-content/plugins/`
4. Faça upload da pasta `wordpress-plugin`
5. Renomeie para `envelope-contribuicao`
6. No WordPress, vá em **Plugins** e ative

### 3️⃣ Usar na Página

1. Crie uma nova página ou edite uma existente
2. No editor, adicione o shortcode:
   ```
   [envelope_contribuicao]
   ```
3. Publique a página
4. Pronto! A calculadora estará funcionando

## 🎨 Personalizações Opcionais

### Adicionar Logo da Igreja

Edite `envelope-contribuicao.php`, linha 22:
```php
<div class="logo-placeholder" style="background-image: url('https://seusite.com/wp-content/uploads/logo.png');"></div>
```

### Mudar Cores do Tema

Edite `assets/css/envelope-contribuicao.css`:
```css
:root {
    --cor-principal: #38b6ff;  /* Cor principal (azul) */
    --cor-texto: #333;         /* Cor do texto */
    --cor-fundo: #f4f7f6;      /* Cor de fundo */
    --cor-borda: #ddd;         /* Cor das bordas */
}
```

## 📋 Checklist de Instalação

- [ ] Plugin compactado em ZIP
- [ ] Upload realizado no WordPress
- [ ] Plugin ativado
- [ ] Shortcode adicionado na página
- [ ] Página publicada
- [ ] Testado no navegador

## ⚠️ Solução de Problemas

**Plugin não aparece após upload:**
- Verifique se o arquivo ZIP contém os arquivos corretos
- Certifique-se de que o arquivo principal é `envelope-contribuicao.php`

**Calculadora não funciona:**
- Limpe o cache do WordPress
- Verifique se o JavaScript está habilitado no navegador
- Teste em modo anônimo do navegador

**Estilos não aparecem:**
- Limpe o cache do navegador (Ctrl+F5)
- Verifique se não há conflito com o tema WordPress
- Desative outros plugins temporariamente para testar

## 📞 Suporte

Para mais ajuda, consulte a documentação do WordPress ou entre em contato com o suporte da Hostinger.
