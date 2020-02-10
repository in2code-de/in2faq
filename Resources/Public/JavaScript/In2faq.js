/**
 * In2faq functions
 *
 * @class In2faq
 */
function In2faq() {
	'use strict';

	/**
	 * @type {string}
	 */
	var openClass = 'open';

	/**
	 * @type {string}
	 */
	var closeClass = 'close';

	/**
	 * Initialize
	 *
	 * @returns {void}
	 */
	this.initialize = function() {
		initiallyCloseAllAnswers();
		addOpenListener();
	};

	/**
	 * @returns {void}
	 */
	var addOpenListener = function() {
		let questions = document.querySelectorAll('[data-in2faq="question"]');
		for (let i = 0; i < questions.length; i++) {
			let question = questions[i];
			question.addEventListener('click', function(event) {
				initiallyCloseAllAnswers();
				let parent = event.target.closest('[data-in2faq="section"]');
				setClassOpen(parent);
				let answer = parent.querySelector('[data-in2faq="answer"]');
				if (answer !== null) {
					showElement(answer);
				}
			});
		}
	};

	/**
	 * @returns {void}
	 */
	var initiallyCloseAllAnswers = function() {
		let answers = document.querySelectorAll('[data-in2faq="answer"]');
		for (let i = 0; i < answers.length; i++) {
			let parent = answers[i].closest('[data-in2faq="section"]');
			setClassClosed(parent);
			hideElement(answers[i]);
		}
	};

	/**
	 * @param {Node} element
	 * @returns {void}
	 */
	var setClassOpen = function(element) {
		element.classList.add(openClass);
		element.classList.remove(closeClass);
	};

	/**
	 * @param {Node} element
	 * @returns {void}
	 */
	var setClassClosed = function(element) {
		element.classList.add(closeClass);
		element.classList.remove(openClass);
	};

	/**
	 * @param {Node} element
	 * @returns {void}
	 */
	var hideElement = function(element) {
		element.style.display = 'none';
	};

	/**
	 * @param {Node} element
	 * @returns {void}
	 */
	var showElement = function(element) {
		element.style.display = 'block';
	};
}

var in2faq = new window.In2faq();
in2faq.initialize();
