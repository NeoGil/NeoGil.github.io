(function(){
	function binary_search(list, item) {
		low = 0;
		high = (list.length)-1;

		while (low <= high) {
			mid = (low + high);
			guess = list[mid];
			if (guess == item) {
				return true;
			} else if ( guess > item) {
				high = mid -1;
			} else {
				low = mid + 1;
			}
		}
		return false;
	}
	function Recycling(material){
		let lengthMaterial = material.length;
		if (lengthMaterial > 15) {
			lengthMaterial = 15;
		} 
		let elementM = [];
		for (var i = 0; elementM.length < lengthMaterial; i++) {
			var a = Math.floor(Math.random() * material.length);
			if ( binary_search(elementM, material[a]) == false) {
				elementM.push(material[a]);
			}
			
		  }
		return elementM;
		  
		  
	}
	function buildQuiz(){
	  // variable to store the HTML output
	  const output = [];
  
	  // for each question...
	myqvest =Recycling(myQuestions);
	  myqvest.forEach(
		(currentQuestion, questionNumber) => {
		
		  // variable to store the list of possible answers
		const answers = [];

		// and for each available answer...
		for(letter in currentQuestion.answers){

		// ...add an HTML radio button
		answers.push(
			`<label class="radio">
			<input  type="checkbox" name="question${questionNumber}" value="${letter}">
			<span>
			${currentQuestion.answers[letter]}</span>
			</label>`
		);
		}

		// add this question and its answers to the output
		output.push(
		`<div class="question"> ${currentQuestion.question} </div>
		<div class="answers"> ${answers.join('')} </div>`
		);
		}
	  );
  
	// finally combine our output list into one string of HTML and put it on the page
	quizContainer.innerHTML = output.join('');
	}

  
	function showResults(){
	// gather answer containers from our quiz correctAnswer
	const answerContainers = quizContainer.querySelectorAll('.answers');
	

	// keep track of user's answers
	let numCorrect = 0;
	// for each question...
	myqvest.forEach( (currentQuestion, questionNumber) => {

		// find selected answer
		const answerContainer = answerContainers[questionNumber];
		const selector = `input[name=question${questionNumber}]:checked`;
		//const userAnswer = (answerContainer.querySelector(selector) || {}).value;
		//console.log(answerContainer);
		var checkbox = document.getElementsByName(`question${questionNumber}`);

		var userAnswer = "";

		for(var i=0; i<checkbox.length; i++){
			if(checkbox[i].checked) {
				userAnswer+=checkbox[i].value+" ";
				userAnswer = userAnswer.replace(/\s+/g, '');
			}
		}
		
		
		// if answer is correct
		if(userAnswer === currentQuestion.correctAnswer){
		  // add to the number of correct answers
		  numCorrect++;
		}
	  });
	let persent = numCorrect/myqvest.length*100;
	// show number of correct answers out of total
	//console.log(persent.toFixed());
	resultsContainer.innerHTML = `${persent.toFixed()}%`;
	}
	const pageContainer = document.getElementsByClassName('page');
	const quizContainer = document.getElementById('quiz');
	const resultsContainer = document.getElementById('results');
	const submitButton = document.getElementById('submit');

	let request = new XMLHttpRequest();

	//request.open(method, url, async, login, pass);
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function()  {
		if (this.readyState == 4 && this.status == 200) {
			window.myQuestions = JSON.parse(this.responseText);
			
		}
	};
	xmlhttp.open("GET", "qwest.json", true);
	xmlhttp.send(); 
	
	
	// Kick things off
	
	// Event listeners
	submitButton.addEventListener('click', function() {
		if (submitButton.textContent == 'Начать тест') {
			buildQuiz();
			submitButton.textContent = 'Проверить';
			window.scrollTo(0, 0);
		} else if (submitButton.textContent == 'Проверить') {
			showResults();
			quizContainer.style.display = 'none';
			submitButton.textContent = 'Начать заново';
			window.scrollTo(0, 0);
			for(var i=0; i<pageContainer.length; i++)pageContainer[i].style.display='block';
		} else if (submitButton.textContent == 'Начать заново') {
			buildQuiz();
			quizContainer.style.display = '';
			submitButton.textContent = 'Проверить';
			window.scrollTo(0, 0);
			for(var i=0; i<pageContainer.length; i++)pageContainer[i].style.display='none';
		} else {
			window.scrollTo(0, 0);
			alert('Ошибка...');
		}
  });
  
})();
