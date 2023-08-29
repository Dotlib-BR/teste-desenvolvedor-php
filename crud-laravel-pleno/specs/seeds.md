## CandidatoSeeder

- Este seeder está criando 20 registros de candidatos usando a factory `Candidato::factory()->count(20)->create();`.
- Cada candidato terá informações fictícias, como nome, e-mail, experiência profissional, habilidades, disponibilidade e datas de criação e atualização.

## InscricaoSeeder

-Este seeder parece simples e direto. Ele está criando 20 registros de inscrição usando a factory `Inscricao::factory()->count(20)->create();.`
- Cada inscrição está associada a uma vaga e um candidato fictício, com datas aleatórias de inscrição.

## UserSeeder

- Similar ao InscricaoSeeder, este seeder cria 10 registros de usuário usando a factory `User::factory()->count(10)->create();`.
-  Cada usuário terá um nome fictício, e-mail, senha criptografada e nível de acesso (Admin ou Usuário).

## VagaSeeder

- Da mesma forma, este seeder está criando 10 registros de vagas usando a factory `Vaga::factory()->count(10)->create();`.
- Cada vaga terá um título, descrição, tipo (CLT, Pessoa Jurídica ou Freelancer), status (Ativa, Pausada ou Encerrada) e datas de criação e atualização fictícias.

**LEGENDA** 
`Seeder` as seeds são scripts para preencher dados no banco de dados de aplicaç~eos web. Dentre as funcionalidades estão: __testes, dados de exemplo, demonstrações, população inicial de dados no BD.__