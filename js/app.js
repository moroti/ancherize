var label = document.querySelector('.dradrop label')

document.addEventListener('drag', function(event) {
    event.preventDefault()
    event.dataTransfer.setData("text", event.target.id)
    console.log('drag')
})

label.addEventListener('dragenter', function(event) {
    event.preventDefault()
    console.log('enter')
    this.style = 'border: 1px solid black;'
})

document.addEventListener('dragover', function(event) {
    event.preventDefault()
    console.log('dragover')
})

label.addEventListener('dragleave', function(event) {
    event.preventDefault()
    console.log('leave')
    this.style = 'border: none;'
})

label.addEventListener('drop', function(event) {
    event.preventDefault()
    debugger
    //label.innerHTML = '<img src="' + event.dataTransfer.getData("text") + '" alt="Illustration faite">'
    console.log(event.dataTransfer.getData("multipart/form-data"))
    debugger
    debugger
})