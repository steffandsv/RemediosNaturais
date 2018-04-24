# RemediosNaturais
Ionic/Cordova Hybrid app to find recipes of natural remedies. Web panel + backend are also included.</br> </br> 
The app has categories and articles, the user can bookmark articles to read later, causing them to be stored on bookmarks page. </br> This app can also be used as news/recipes, for example.
</br>
## Screenshots</br>
![Imagens do aplicativo](https://i.imgur.com/DnugJjK.jpg)
</br>
![Painel online](https://i.imgur.com/XX9XPDv.png)
</br>
![Painel](https://i.imgur.com/yFo4ySF.png)
</br>
</br>
## Setup

Create a database and run the query: "/Backend/rest-api.sql"</br>

Add SQL config/host in the first line of the files:</br>
/Backend/web-admin.php</br>

/Backend/rest-api.php</br>

The default user/pass to login in the web panel are:</br>
admin</br>
admin</br> (change it in the lines 8 'n 9 in the file /Backend/web-admin.php)</br>

After setup the rest-api/panel, add the url to your installation where there is the expression "seusite" in the lines 452,454,973,975,1513,1515 of file /App/www/js/controllers.js</br>

Now you can build your app using Ionic/Cordova.</br>
Install the necessary plugins:</br>

> cordova plugin add cordova-plugin-device --save </br>
> cordova plugin add cordova-plugin-console --save </br>
> cordova plugin add cordova-plugin-splashscreen --save </br>
> cordova plugin add cordova-plugin-statusbar --save </br>
> cordova plugin add cordova-plugin-whitelist --save </br>
> cordova plugin add ionic-plugin-keyboard --save </br>
> cordova plugin add cordova-plugin-dialogs --save </br>
> cordova plugin add cordova-plugin-inappbrowser --save </br>

## Thanks!