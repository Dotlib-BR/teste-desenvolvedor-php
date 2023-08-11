# Use uma imagem base com Node.js pré-instalado
FROM node:alpine

# Diretório de trabalho dentro do contêiner
WORKDIR /app

# Copie os arquivos do diretório atual para o diretório de trabalho do contêiner
COPY . .

# Instale as dependências
RUN npm install

# Comando padrão para executar os testes
CMD ["npm", "test"]