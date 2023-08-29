## CandidatoFactory
- Define as propriedades de um candidato; como nome, e-mail, experiência profissional, habilidades, disponibilidade, data de criação e atualização.
- Utiliza o `faker` para gerar dados fictícios, como nome, e-mail e parágrafos aleatórios.
- Define a disponibilidade como "Integral" ou "Meio Período" de forma aleatória.
- Cria um candidato com base nos atributos definidos.

## InscricaoFactory

- Define as propriedades de uma inscrição, como o ID da vaga, o ID do candidato e a data de inscrição.
- Utiliza o `faker` para gerar dados aleatórios para a vaga e o candidato.
- Define a data da inscrição como um intervalo aleatório dentro do último ano.
- Cria uma inscrição com base nos atributos definidos.

## UserFactory
- Define as propriedades de um usuário, como nome, e-mail, senha, nível de acesso, etc.
- Utiliza o `faker` para gerar nome, e-mail e outras informações fictícias.
- Define senhas e níveis de acesso aleatórios.
- Pode gerar usuários com diferentes níveis de verificação de e-mail (verificados ou não).
- Cria um usuário com base nos atributos definidos.

## VagaFactory
- Define as propriedades de uma vaga, como título, descrição, tipo, status, etc.
- Utiliza o `faker` para gerar títulos, descrições e outros dados fictícios.
- Define tipos de vaga como `"CLT", "Pessoa Jurídica" ou "Freelancer"`.
- Define status da vaga como `"Ativa", "Pausada" ou "Encerrada"`.
- Cria uma vaga com base nos atributos definidos.

**LEGENDA** 
 `faker` é uma biblioteca em PHGP para gerar dados fictícios. Dentre estes: números, strings, datas e horas.
 `Factory` as factories são utilizadas para; __tested unitários e de integração, preenchimento de dados, desenvolver interfaces de usuários e cenários de demonstração.__