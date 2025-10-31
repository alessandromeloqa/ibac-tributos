# Envelope de Contribuição - Plugin WordPress

## Instalação na Hostinger/WordPress

### Método 1: Upload via Painel WordPress (Recomendado)

1. **Compactar o plugin**
   - Compacte a pasta `wordpress-plugin` em um arquivo ZIP
   - Renomeie para `envelope-contribuicao.zip`

2. **Fazer upload no WordPress**
   - Acesse seu painel WordPress (seusite.com/wp-admin)
   - Vá em **Plugins → Adicionar novo**
   - Clique em **Enviar plugin**
   - Escolha o arquivo `envelope-contribuicao.zip`
   - Clique em **Instalar agora**
   - Após instalação, clique em **Ativar**

3. **Usar o plugin**
   - Crie ou edite uma página
   - Adicione o shortcode: `[envelope_contribuicao]`
   - Publique a página

### Método 2: Upload via FTP/Gerenciador de Arquivos

1. **Acessar arquivos do WordPress**
   - Entre no painel da Hostinger
   - Vá em **Gerenciador de Arquivos** ou use FTP

2. **Fazer upload**
   - Navegue até: `public_html/wp-content/plugins/`
   - Faça upload da pasta `wordpress-plugin`
   - Renomeie para `envelope-contribuicao`

3. **Ativar o plugin**
   - Acesse o painel WordPress
   - Vá em **Plugins**
   - Ative o plugin "Envelope de Contribuição"

4. **Usar o plugin**
   - Adicione `[envelope_contribuicao]` em qualquer página

## Personalização

### Alterar nome da igreja
Edite o arquivo `envelope-contribuicao.php`, linha 23:
```php
<h1>Igreja Batista Vida só em Jesus</h1>
```

### Adicionar logo
Substitua a linha 22 por:
```php
<div class="logo-placeholder" style="background-image: url('URL_DA_SUA_LOGO');"></div>
```

### Alterar cores
Edite `assets/css/envelope-contribuicao.css`, linhas 1-5:
```css
:root {
    --cor-principal: #38b6ff;
    --cor-texto: #333;
    --cor-fundo: #f4f7f6;
    --cor-borda: #ddd;
}
```

## Estrutura de Arquivos

```
envelope-contribuicao/
├── envelope-contribuicao.php    (Plugin principal)
├── assets/
│   ├── css/
│   │   └── envelope-contribuicao.css
│   └── js/
│       └── envelope-contribuicao.js
└── README.md
```

## Suporte

Para dúvidas ou problemas, entre em contato com o administrador do site.
