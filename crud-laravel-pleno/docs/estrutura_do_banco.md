# Estrutura do Banco de Dados

## Tabela: Vagas

- **ID:** (chave primária)
- **Título da Vaga**
- **Descrição da Vaga**
- **Tipo de Vaga:** (CLT, Pessoa Jurídica, Freelancer)
- **Status da Vaga:** (Ativa, Pausada, Encerrada)
- **Data de Criação**
- **Data de Modificação**

## Tabela: Candidatos

- **ID:** (chave primária)
- **Nome do Candidato**
- **E-mail do Candidato**
- **Experiência Profissional**
- **Habilidades**
- **Disponibilidade**
- **Data de Criação**
- **Data de Modificação**

## Tabela: Inscrições

- **ID:** (chave primária)
- **ID da Vaga:** (chave estrangeira referenciando a tabela Vagas)
- **ID do Candidato:** (chave estrangeira referenciando a tabela Candidatos)
- **Data de Inscrição**

## Tabela: Usuários

- **ID:** (chave primária)
- **Name**
- **E-mail do Usuário**
- **Senha Criptografada**
- **Nível de Acesso:** (Admin, Usuário)
- **Data de Criação e Modificação**

