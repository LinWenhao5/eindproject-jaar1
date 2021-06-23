const codeDisplayElement = document.getElementById('codeDisplay')
const codeInputElement = document.getElementById('codeInput')
const timerElement = document.getElementById('timer')
const chararray = []

codeInputElement.addEventListener('input', () => {
    const arrayCode = codeDisplayElement.querySelectorAll('span')
    const arrayValue = codeInputElement.value.split('')
    
    let correct = true
    arrayCode.forEach((characterSpan, index) => {
        const character = arrayValue[index]
        if (character === ' ') {
            characterSpan.classList.add('correct')
            characterSpan.classList.remove('incorrect')
        }
        if (character == null) {
            characterSpan.classList.remove('correct')
            characterSpan.classList.remove('incorrect')
            correct = false
        }
        else if (character === chararray[index]) {
            characterSpan.classList.add('correct')
            characterSpan.classList.remove('incorrect')
        }   else {
            characterSpan.classList.remove('correct')
            characterSpan.classList.add('incorrect')
            correct = false
        }
    })
    
    if (correct) newPage()
})




function Hidecode() {
    var button = document.getElementsByClassName("front-button-inner");
    
    if (button.clicked)   {

    document.getElementsByClassName("codeDisplay").style.display = ("none");
    document.getElementById('codeInput').style.display = 'none';

    } else {
    document.getElementById('codeInput').style.display = 'block';
      doStuff()
      document.getElementById("codeInput").focus();
    }
  }


    function doStuff() {
    const code = document.getElementById('text').innerText;
    codeDisplayElement.innerHTML = ''
    code.split('').forEach(character => {
        console.log(`char: ${character} = utf-16: ${character.codePointAt(0)}`);
        const characterSpan = document.createElement('span')
        chararray.push(character)
        characterSpan.innerText = character
        codeDisplayElement.appendChild(characterSpan)
    })
    codeInputElement.value = null
}
let startTime
function startTimer() {  
    timerElement.innerText = 0
    startTime = new Date()
    setInterval(() => {
        const tijd = getTimerTime()
        const seconds = Math.floor(tijd / 100)
        let milliseconds = tijd % 100
        if (milliseconds <= 9) {
            milliseconds = `${milliseconds}`
        }
        timer.innerText = `${seconds}.${milliseconds}`
    }, 10)
}

function getTimerTime() {  
    return Math.floor((new Date() - startTime) / 10)
}


function newPage() {
    let value = timer.innerHTML;
    document.cookie = `tijd=${encrypt(value)}`
    console.log(`tijd=${value}`)
    const page = window.location.href
    // console.log(location)
    // document.location.href = `end_page.php?time=${value}`
    window.location.replace("end_page.php?do=display")
}


// function getCode() {
//     return fetch('code.txt')
//         .then(respose => respose.text())
//         .then(text => text)
// }

// async function renderNewCode() {
//     const code = getCode()
//     codeDisplayElement.innerHTML = code
// }

HTMLTextAreaElement.prototype.getCaretPosition = function () { //return the caret position of the textarea
    return this.selectionStart;
};
HTMLTextAreaElement.prototype.setCaretPosition = function (position) { //change the caret position of the textarea
    this.selectionStart = position;
    this.selectionEnd = position;
    this.focus();
};
HTMLTextAreaElement.prototype.hasSelection = function () { //if the textarea has selection then return true
    if (this.selectionStart == this.selectionEnd) {
        return false;
    } else {
        return true;
    }
};
HTMLTextAreaElement.prototype.getSelectedText = function () { //return the selection text
    return this.value.substring(this.selectionStart, this.selectionEnd);
};
HTMLTextAreaElement.prototype.setSelection = function (start, end) { //change the selection area of the textarea
    this.selectionStart = start;
    this.selectionEnd = end;
    this.focus();
};

var textarea = document.getElementsByTagName('textarea')[0]; 

textarea.onkeydown = function(event) {
    
    //support tab on textarea
    if (event.keyCode == 9) { //tab was pressed
        var newCaretPosition;
        newCaretPosition = textarea.getCaretPosition() + "    ".length;
        textarea.value = textarea.value.substring(0, textarea.getCaretPosition()) + "    " + textarea.value.substring(textarea.getCaretPosition(), textarea.value.length);
        textarea.setCaretPosition(newCaretPosition);
        return false;
    }
    if(event.keyCode == 8){ //backspace
        if (textarea.value.substring(textarea.getCaretPosition() - 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
            var newCaretPosition;
            newCaretPosition = textarea.getCaretPosition() - 3;
            textarea.value = textarea.value.substring(0, textarea.getCaretPosition() - 3) + textarea.value.substring(textarea.getCaretPosition(), textarea.value.length);
            textarea.setCaretPosition(newCaretPosition);
        }
    }
    if(event.keyCode == 37){ //left arrow
        var newCaretPosition;
        if (textarea.value.substring(textarea.getCaretPosition() - 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
            newCaretPosition = textarea.getCaretPosition() - 3;
            textarea.setCaretPosition(newCaretPosition);
        }    
    }
    if(event.keyCode == 39){ //right arrow
        var newCaretPosition;
        if (textarea.value.substring(textarea.getCaretPosition() + 4, textarea.getCaretPosition()) == "    ") { //it's a tab space
            newCaretPosition = textarea.getCaretPosition() + 3;
            textarea.setCaretPosition(newCaretPosition);
        }
    } 
}

function encrypt(message = ''){
    let key = CryptoJS.enc.Hex.parse("0123456789abcdef0123456789abcdef");
    let iv =  CryptoJS.enc.Hex.parse("abcdef9876543210abcdef9876543210");
    var message = CryptoJS.AES.encrypt(message, key, {iv:iv, padding:CryptoJS.pad.ZeroPadding});
    return message.toString();
}
function decrypt(message = '', key = ''){
    var code = CryptoJS.AES.decrypt(message, key);
    var decryptedMessage = code.toString(CryptoJS.enc.Utf8);

    return decryptedMessage;
}
console.log(encrypt('Hello World'));
console.log(decrypt('U2FsdGVkX1/VN89PD4nGUMmVkvZh128CGFPWTuQCG0k=', 'abc'))

