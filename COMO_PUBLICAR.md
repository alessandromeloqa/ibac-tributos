# 🎯 Como Publicar no WordPress - Guia Prático

## PASSO 1: Compactar o Plugin

### Windows:
1. Abra a pasta `wordpress-plugin`
2. Selecione TODOS os arquivos e pastas dentro (Ctrl+A)
3. Clique com botão direito → **Enviar para** → **Pasta compactada**
4. Renomeie o arquivo para: `envelope-contribuicao.zip`

**⚠️ IMPORTANTE:** O ZIP deve conter os arquivos diretamente, não a pasta!

Estrutura correta do ZIP:
```
envelope-contribuicao.zip
├── envelope-contribuicao.php
├── assets/
└── README.md
```

## PASSO 2: Acessar o WordPress

1. Abra seu navegador
2. Digite: `seusite.com.br/wp-admin`
3. Faça login com usuário e senha

## PASSO 3: Instalar o Plugin

1. No menu lateral esquerdo, clique em **Plugins**
2. Clique em **Adicionar novo** (topo da página)
3. Clique no botão **Enviar plugin** (topo da página)
4. Clique em **Escolher arquivo**
5. Selecione o arquivo `envelope-contribuicao.zip`
6. Clique em **Instalar agora**
7. Aguarde a mensagem: "Plugin instalado com sucesso"
8. Clique em **Ativar plugin**

## PASSO 4: Criar uma Página

### Opção A: Criar Nova Página
1. Menu lateral → **Páginas** → **Adicionar nova**
2. Digite um título: "Calculadora de Contribuição"
3. No editor, adicione um bloco de **Shortcode**
4. Digite: `[envelope_contribuicao]`
5. Clique em **Publicar** (canto superior direito)

### Opção B: Adicionar em Página Existente
1. Menu lateral → **Páginas** → **Todas as páginas**
2. Clique em **Editar** na página desejada
3. Adicione um bloco de **Shortcode**
4. Digite: `[envelope_contribuicao]`
5. Clique em **Atualizar**

## PASSO 5: Visualizar

1. Clique em **Ver página** ou **Visualizar**
2. A calculadora deve aparecer funcionando!

---

## 🎨 PERSONALIZAÇÕES (Opcional)

### Adicionar Logo da Igreja

1. Faça upload da logo: **Mídia** → **Adicionar nova**
2. Copie a URL da imagem
3. Vá em **Plugins** → **Editor de plugins**
4. Selecione: "Envelope de Contribuição"
5. Abra: `envelope-contribuicao.php`
6. Encontre a linha 22:
   ```php
   <div class="logo-placeholder">Sua Logo</div>
   ```
7. Substitua por:
   ```php
   <div class="logo-placeholder" style="background-image: url('URL_DA_LOGO_AQUI');"></div>
   ```
8. Clique em **Atualizar arquivo**

### Mudar Nome da Igreja

1. No mesmo arquivo, linha 23:
   ```php
   <h1>Igreja Batista Vida só em Jesus</h1>
   ```
2. Altere o nome conforme desejado
3. Clique em **Atualizar arquivo**

---

## ✅ CHECKLIST FINAL

- [ ] Arquivo ZIP criado corretamente
- [ ] Plugin instalado no WordPress
- [ ] Plugin ativado
- [ ] Página criada ou editada
- [ ] Shortcode `[envelope_contribuicao]` adicionado
- [ ] Página publicada
- [ ] Testado no navegador
- [ ] Calculadora funcionando (digite um valor e veja os cálculos)

---

## 🆘 PROBLEMAS COMUNS

### "O plugin não tem um cabeçalho válido"
**Solução:** O ZIP está errado. Refaça compactando os ARQUIVOS, não a pasta.

### "Plugin instalado mas não aparece nada"
**Solução:** Você adicionou o shortcode `[envelope_contribuicao]` na página?

### "Calculadora aparece sem estilo"
**Solução:** 
1. Limpe o cache: Ctrl+F5
2. Vá em **Plugins** → Desative e ative novamente

### "Não consigo editar o plugin"
**Solução:** Use FTP ou Gerenciador de Arquivos da Hostinger:
- Caminho: `public_html/wp-content/plugins/envelope-contribuicao/`

---

## 📱 TESTAR NO CELULAR

1. Abra a página no celular
2. Digite um valor de salário
3. Verifique se os cálculos funcionam
4. Teste a responsividade

---

## 🔄 ATUALIZAR O PLUGIN

Se precisar fazer alterações:

1. Desative o plugin no WordPress
2. Delete o plugin antigo
3. Faça as alterações nos arquivos
4. Crie novo ZIP
5. Instale novamente

**OU** edite diretamente via FTP/Gerenciador de Arquivos.
