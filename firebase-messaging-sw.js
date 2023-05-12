importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js')
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js')

firebase.initializeApp({
	apiKey: "AIzaSyBCwBJ8w59UZSVe8cSus5s-2qiTi3J5aHQ",
	authDomain: "real-good-help-d42ac.firebaseapp.com",
	projectId: "real-good-help-d42ac",
	storageBucket: "real-good-help-d42ac.appspot.com",
	messagingSenderId: "194534504607",
	appId: "1:194534504607:web:d42817622c694fcc494aaa"
})

const messaging = firebase.messaging()

messaging.setBackgroundMessageHandler((payload) => {
	console.log(payload)
})