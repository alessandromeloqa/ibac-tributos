# 🚀 Como Executar o Projeto Localmente

## Método 1: Abrir Diretamente no Navegador (Mais Simples)

### Passo a Passo:

1. Navegue até a pasta do projeto:
   ```
   d:\Estudos\ibac-tributos
   ```

2. Localize o arquivo:
   ```
   envelope_contribuicao.html
   ```

3. **Clique duas vezes** no arquivo OU clique com botão direito → **Abrir com** → **Navegador de sua preferência**

4. Pronto! A calculadora abrirá no navegador e estará funcionando.

### Atalho Rápido:
- Arraste o arquivo `envelope_contribuicao.html` para dentro do navegador aberto

---

## Método 2: Usar Live Server (Para Desenvolvimento)

### Se você usa VS Code:

1. Instale a extensão **Live Server**:
   - Abra VS Code
   - Vá em Extensions (Ctrl+Shift+X)
   - Procure por "Live Server"
   - Clique em Install

2. Abra o arquivo `envelope_contribuicao.html` no VS Code

3. Clique com botão direito no arquivo → **Open with Live Server**

4. O navegador abrirá automaticamente em:
   ```
   http://127.0.0.1:5500/envelope_contribuicao.html
   ```

### Vantagens:
- Atualização automática ao salvar alterações
- Melhor para desenvolvimento e testes

---

## Método 3: Servidor HTTP Simples (Python)

### Se você tem Python instalado:

1. Abra o terminal/prompt na pasta do projeto:
   ```bash
   cd d:\Estudos\ibac-tributos
   ```

2. Execute o comando:
   ```bash
   python -m http.server 8000
   ```

3. Abra o navegador e acesse:
   ```
   http://localhost:8000/envelope_contribuicao.html
   ```

4. Para parar o servidor: **Ctrl+C** no terminal

---

## Método 4: Testar Plugin WordPress Localmente

### Requisitos:
- XAMPP, WAMP, Local by Flywheel ou similar
- WordPress instalado localmente

### Passo a Passo:

1. **Instale ambiente local** (exemplo com XAMPP):
   - Baixe XAMPP: https://www.apachefriends.org/
   - Instale e inicie Apache e MySQL

2. **Instale WordPress**:
   - Baixe WordPress: https://br.wordpress.org/download/
   - Extraia em: `C:\xampp\htdocs\wordpress`
   - Acesse: `http://localhost/wordpress`
   - Complete a instalação

3. **Instale o plugin**:
   - Copie a pasta `wordpress-plugin` para:
     ```
     C:\xampp\htdocs\wordpress\wp-content\plugins\envelope-contribuicao
     ```
   - Acesse: `http://localhost/wordpress/wp-admin`
   - Vá em **Plugins** → Ative "Envelope de Contribuição"

4. **Use o shortcode**:
   - Crie uma página
   - Adicione: `[envelope_contribuicao]`
   - Publique e visualize

---

## 🧪 Testar Funcionalidades

Após abrir o projeto, teste:

1. **Digite um valor**: 3000
2. **Verifique se calcula**:
   - Total: R$ 495,00
   - Primícias: 100.00
   - Dízimo: 290.00
   - Socorro: 60.00
   - Gratidão: 3.00
   - Semeadura: 12.00
   - Israel: 30.00

3. **Teste responsividade**:
   - Pressione F12 (DevTools)
   - Clique no ícone de dispositivo móvel
   - Teste em diferentes tamanhos

---

## 📝 Fazer Alterações

### Para editar o projeto:

1. Abra o arquivo no editor de código:
   - VS Code (recomendado)
   - Notepad++
   - Sublime Text
   - Ou qualquer editor de texto

2. Edite o arquivo `envelope_contribuicao.html`

3. Salve (Ctrl+S)

4. Atualize o navegador (F5 ou Ctrl+F5)

---

## ⚡ Dica Rápida

**Forma mais rápida de executar:**

1. Abra o Windows Explorer
2. Navegue até: `d:\Estudos\ibac-tributos`
3. Clique duas vezes em: `envelope_contribuicao.html`
4. Pronto! ✅

Não precisa de servidor, instalação ou configuração adicional!
