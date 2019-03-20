<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>dotlib CRUD</title>
  <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
</head>
<body>
  <div id="app">
    <v-app>

      <v-navigation-drawer v-model="drawer" fixed app>
        <v-list dense>
          <v-list-tile @click="drawer = !drawer" v-if="this.$vuetify.breakpoint.smAndDown">
            <v-list-tile-action>
              <v-icon>close</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              FECHAR
            </v-list-tile-content>              
          </v-list-tile>

          <v-list-group>
            <v-list-tile slot="activator">
              <v-list-tile-action>
                <v-icon>person</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
                  CLIENTES
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-list-tile>
              <v-list-tile-action></v-list-tile-action>
              <v-list-tile-content>
                CRIAR NOVO CLIENTE
              </v-list-tile-content>              
            </v-list-tile>

            <v-list-tile to='/'>
              <v-list-tile-action></v-list-tile-action>
              <v-list-tile-content>
                LISTAR TODOS CLIENTES
              </v-list-tile-content>              
            </v-list-tile>
          </v-list-group>

          <v-list-group>
            <v-list-tile slot="activator">
              <v-list-tile-action>
                <v-icon>shopping_cart</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
                  PRODUTOS
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-list-tile>
              <v-list-tile-action></v-list-tile-action>
              <v-list-tile-content>
                CRIAR NOVO PRODUTO
              </v-list-tile-content>              
            </v-list-tile>

            <v-list-tile to='/listaProdutos'>
              <v-list-tile-action></v-list-tile-action>
              <v-list-tile-content>
                LISTAR TODOS PRODUTOS
              </v-list-tile-content>              
            </v-list-tile>
          </v-list-group>

          <v-list-group>
            <v-list-tile slot="activator">
              <v-list-tile-action>
                <v-icon>bookmark</v-icon>
              </v-list-tile-action>
              <v-list-tile-content>
                <v-list-tile-title>
                  PEDIDOS
                </v-list-tile-title>
              </v-list-tile-content>
            </v-list-tile>

            <v-list-tile>
              <v-list-tile-action></v-list-tile-action>
              <v-list-tile-content>
                CRIAR NOVO PEDIDO
              </v-list-tile-content>              
            </v-list-tile>

            <v-list-tile to="/listaPedidos">
              <v-list-tile-action></v-list-tile-action>
              <v-list-tile-content>
                LISTAR TODOS PEDIDOS
              </v-list-tile-content>              
            </v-list-tile>
          </v-list-group>
        </v-list>
      </v-navigation-drawer>

      <v-toolbar color="primary" dark fixed app>
        <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
        <v-toolbar-title>dotlib</v-toolbar-title>
      </v-toolbar>

      <v-content>
        <v-container fluid fill-height>
          <router-view></router-view>
        </v-container>
      </v-content>
    </v-app>
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>