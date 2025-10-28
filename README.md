# Envelope de Contribuição

![Version](https://img.shields.io/badge/version-1.0.2-blue.svg)

Calculadora digital para contribuições da Igreja Batista Vida só em Jesus.

## Funcionalidades

- **Cálculo automático** baseado na remuneração mensal
- **Máscara de valor** em formato brasileiro (R$ 1.500,00)
- **Campos de contribuição**:
  - Primícias: Salário ÷ 30
  - Dízimo: 10% do (Salário - Primícias)
  - Socorro: 2% do salário
  - Gratidão: 0,1% do salário
  - Semeadura: 0,4% do salário
  - Israel: 1% do salário

## Como usar

1. Digite sua remuneração mensal
2. Os valores são calculados automaticamente
3. Você pode ajustar manualmente qualquer campo
4. O total é atualizado em tempo real

## Tecnologias

- HTML5
- CSS3
- JavaScript (Vanilla)

## Instalação

### Versão Standalone
Baixe o arquivo `envelope_contribuicao.html` e abra no navegador.

### Plugin WordPress
1. Compacte a pasta `wordpress-plugin` em ZIP
2. No WordPress: Plugins → Adicionar novo → Enviar plugin
3. Faça upload do ZIP e ative
4. Use o shortcode `[envelope_contribuicao]` em qualquer página

Veja [COMO_PUBLICAR.md](COMO_PUBLICAR.md) para instruções detalhadas.

## Versionamento

Este projeto usa [Versionamento Semântico](https://semver.org/lang/pt-BR/). Veja o [CHANGELOG.md](CHANGELOG.md) para histórico de versões.