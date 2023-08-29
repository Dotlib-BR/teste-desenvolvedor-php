## Candidato:

- Define as propriedades de um candidato, como nome, e-mail, experiência profissional, habilidades e disponibilidade.
- Utiliza o `HasFactory` pra habilitar o uso de factories na criação de instâncias.
- Define relacionamento "um para muitos" com as inscrições, assim um candidato poderá ter várias inscrições.

## Inscricao:

- Define as propriedades de uma inscrição, como o ID da vaga, o ID do candidato e a data de inscrição.
- Utiliza o `HasFactory` para habilitar o uso de factories na criação de instâncias.
- Define o relacionamento de "muitos para um" com o candidato, dessa forma uma inscrição pertencerá a um candidato.
- Define o relacionamento de 'muitos para um" com a vaga, assimuma inscrição pertence a uma vaga.

## User:

- Define as propriedades de um usuário, como nome, e-mail, senha, etc.
- Utiliza `HasApiTokens`, `HasFactory` e `Notifiable` para habilitar funcionalidades específicas.
- Define o relacionamento de "um para muitos" através de inscrições, indicando que um usuário pode ter várias inscrições através de sua associação com candidatos.

## Vaga:

- Define as propriedades de uma vaga, como título, descrição, tipo e status.
- Utiliza `HasFactory` para habilitar o uso de factories na criação de instâncias.
- Define o relacionamento de "um para muitos" com as inscrições, indicando que uma vaga pode ter várias inscrições.

**LEGENDA:**
`HasFactory`, `HasApiTokens`, `HasFactory` e `Notifiable` são mixins, comportamentos ou módulos. Que ajudam na composição, reutilização de código, conflitos de métodos.
`Model` as models são representações da estrutura de dados do app, integrando com o banco de dados e permitindo operações como leitura, gravação, update e delete.
Das responsabilidades dasModels; __Relacionamentos, Validar dados, Migrações, Segurança, Orgfaniação e intermediação entre o banco de dados e a aplicação(mediar a interação com as regras de negócios e coordenação das ações de lógica).__