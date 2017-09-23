import Firebase from 'firebase';
  var config = {
    apiKey: "AIzaSyCqYTHaEUnfhRSC8s-5-EFBUrq8litBtqw",
    authDomain: "cryptotrak.firebaseapp.com",
    databaseURL: "https://cryptotrak.firebaseio.com",
    projectId: "cryptotrak",
    storageBucket: "cryptotrak.appspot.com",
    messagingSenderId: "458544227545"
  };
let firebaseApp = Firebase.initializeApp(config);
let FBApp = firebaseApp.database();

let allCoinsRef = FBApp.ref('cryptotrak/allCoins')

var storage = firebaseApp.storage();

// Create a storage reference from our storage service
var storageRef = storage.ref();


export default {
	FBApp,
	allCoinsRef,
	storageRef
}
