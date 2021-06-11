now = new Date();

localTime = now.toString();
utcTime = now.toGMTString();

document.write("<b>Local Time: </b>" + localTime + "<br><br>");
document.write("<b>UTC Time: </b>" + utcTime + "<br><br>");

// hours = now.getHours();
// mins = now.getMinutes();
// secs = now.getSeconds();

// // document.write("<b>");
// document.write(hours + ":" + mins + ":" secs);
// document.write(</b>)