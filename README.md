# RemediosNaturais
Aplicativo multiplataforma destinado a encontrar receitas de remédios caseiros e tratamentos homeopáticos.</br> </br> O aplicativo conta com sistema de categorias e artigos, o usuário pode marcar artigos que entender relevante por meio do "Bookmark", ficando armazenados em pagina própria para fácil acesso posterior. </br>Há planos futuros de implementar um sistema de envio de sugestões de receitas pelos usuários.
</br>
## Screenshots</br>
![Imagens do aplicativo](https://i.imgur.com/DnugJjK.jpg)
</br>
![Painel online](https://i.imgur.com/XX9XPDv.png)
</br>
![Painel](https://i.imgur.com/yFo4ySF.png)
</br>
</br>
## Como Instalar e Configurar

Crie uma database e rode nela a query contida em "/Backend/rest-api.sql"</br>

Adicione as configurações do seu servidor SQL nos parâmetros contidos nas primeiras linhas dos arquivos:</br>
/Backend/web-admin.php</br>

/Backend/rest-api.php</br>

O usuário e a senha padrão para login no painel são:</br>
admin</br>
admin</br> (podem ser alterados modificando-se as linhas 8 e 9 do arquivo /Backend/web-admin.php)</br>

Após a correta instalação da rest-api e do painel, adicione o endereço online da instalação no lugar da expressão "seusite" contida nas linhas 452,454,973,975,1513,1515 do arquivo /App/www/js/controllers.js</br>

Após isso, você já está pronto para compilar seu aplicativo utilizando Cordova ou Ionic.</br>
Abaixo uma lista de comandos que deverá ser executada para instalar todos os plugins utilizados:</br>

> cordova plugin add cordova-plugin-device --save </br>
> cordova plugin add cordova-plugin-console --save </br>
> cordova plugin add cordova-plugin-splashscreen --save </br>
> cordova plugin add cordova-plugin-statusbar --save </br>
> cordova plugin add cordova-plugin-whitelist --save </br>
> cordova plugin add ionic-plugin-keyboard --save </br>
> cordova plugin add cordova-plugin-dialogs --save </br>
> cordova plugin add cordova-plugin-inappbrowser --save </br>


Finalmente, adicione as plataformas para as quais você deseja compilar o app:

> cordova platform add android

ou

> cordova platform add ios

Rode os comandos de pré-compilação:

> cordova clean </br>
> cordova requirements


Compile:

> cordova build android[ou ios]