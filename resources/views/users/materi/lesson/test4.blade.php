@extends('layouts.main.index')
 
@section('container')

<div class="container">
            {{-- Back Button --}}
  <div class="mb-3">
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
    ← Back
    </a>
  </div>
 <div class="card shadow-sm">
    <h1>🎯 English Grammar Word Sorting Game</h1>
    <p>Drag and drop the words into the correct boxes (Verbs or Nouns).</p>
    
    <div class="score-display">
        Score: <span id="score">0</span> | Attempts: <span id="attempts">0</span>
    </div>
    
    <div id="feedback"></div>
    
    <div class="game-container">
        <div id="leftBox" class="box" ondragover="allowDrop(event)" ondrop="drop(event)">
            <div class="box-title">Verbs (Action words)</div>
            <div class="words-container" id="verbsContainer"></div>
        </div>
        
        <div id="middleBox" class="box">
            <div class="box-title">Words to Sort</div>
            <div class="words-container" id="wordsContainer">
                <div class="word" draggable="true" id="word1" data-type="verb">run</div>
                <div class="word" draggable="true" id="word2" data-type="verb">jump</div>
                <div class="word" draggable="true" id="word3" data-type="noun">elephant</div>
                <div class="word" draggable="true" id="word4" data-type="noun">Taj Mahal</div>
                <div class="word" draggable="true" id="word5" data-type="verb">swim</div>
                <div class="word" draggable="true" id="word6" data-type="noun">book</div>
                <div class="word" draggable="true" id="word7" data-type="verb">write</div>
                <div class="word" draggable="true" id="word8" data-type="noun">teacher</div>
            </div>
        </div>
        
        <div id="rightBox" class="box" ondragover="allowDrop(event)" ondrop="drop(event)">
            <div class="box-title">Nouns (Person, Place, Animal, Thing)</div>
            <div class="words-container" id="nounsContainer"></div>
        </div>
    </div>
    
    <button id="checkButton" onclick="checkAnswers()">Check Answers</button>
    <button id="resetButton" onclick="resetGame()" style="display: block; margin: 10px auto; padding: 10px 20px; background-color: #f44336; color: white; border: none; border-radius: 4px; cursor: pointer;">Reset Game</button>

 </div>
    
</div>

@section('script')
<script>
        // Game state
        let score = 0;
        let attempts = 0;
        let currentWords = [];
        
        // Initialize the game
        document.addEventListener('DOMContentLoaded', function() {
            const words = document.querySelectorAll('.word');
            words.forEach(word => {
                word.addEventListener('dragstart', dragStart);
            });
            
            // Store original words for reset
            currentWords = Array.from(words).map(word => ({
                id: word.id,
                text: word.textContent,
                type: word.getAttribute('data-type')
            }));
        });
        
        function dragStart(event) {
            event.dataTransfer.setData('text/plain', event.target.id);
        }
        
        function allowDrop(event) {
            event.preventDefault();
        }
        
        function drop(event) {
            event.preventDefault();
            const id = event.dataTransfer.getData('text/plain');
            const draggedElement = document.getElementById(id);
            
            // Only allow dropping into the verb or noun containers
            if (event.target.id === 'leftBox' || event.target.id === 'rightBox' || 
                event.target.parentElement.id === 'verbsContainer' || 
                event.target.parentElement.id === 'nounsContainer') {
                
                // Determine the actual drop target (either the box or its container)
                let dropTarget;
                if (event.target.id === 'leftBox' || event.target.id === 'rightBox') {
                    dropTarget = event.target.querySelector('.words-container');
                } else if (event.target.classList.contains('words-container')) {
                    dropTarget = event.target;
                } else {
                    dropTarget = event.target.closest('.words-container');
                }
                
                // Move the element to the drop target
                if (dropTarget && draggedElement) {
                    dropTarget.appendChild(draggedElement);
                    
                    // Remove any previous feedback classes
                    draggedElement.classList.remove('correct', 'incorrect');
                }
            }
        }
        
        function checkAnswers() {
            let correct = 0;
            let total = 0;
            
            // Check verbs
            const verbContainer = document.getElementById('verbsContainer');
            const verbWords = verbContainer.querySelectorAll('.word');
            
            verbWords.forEach(word => {
                total++;
                if (word.getAttribute('data-type') === 'verb') {
                    word.classList.add('correct');
                    correct++;
                } else {
                    word.classList.add('incorrect');
                }
            });
            
            // Check nouns
            const nounContainer = document.getElementById('nounsContainer');
            const nounWords = nounContainer.querySelectorAll('.word');
            
            nounWords.forEach(word => {
                total++;
                if (word.getAttribute('data-type') === 'noun') {
                    word.classList.add('correct');
                    correct++;
                } else {
                    word.classList.add('incorrect');
                }
            });
            
            // Update score and attempts
            attempts++;
            score = Math.round((correct / total) * 100);
            
            document.getElementById('score').textContent = score;
            document.getElementById('attempts').textContent = attempts;
            
            // Provide feedback
            const feedback = document.getElementById('feedback');
            if (correct === total) {
                feedback.textContent = 'Perfect! All words are in the correct boxes!';
                feedback.style.color = '#4CAF50';
            } else if (correct >= total / 2) {
                feedback.textContent = 'Good job! But some words are in the wrong boxes.';
                feedback.style.color = '#FFC107';
            } else {
                feedback.textContent = 'Keep trying! Review verbs and nouns and try again.';
                feedback.style.color = '#F44336';
            }
        }
        
        function resetGame() {
            // Clear containers
            document.getElementById('verbsContainer').innerHTML = '';
            document.getElementById('nounsContainer').innerHTML = '';
            
            // Reset words to middle container
            const wordsContainer = document.getElementById('wordsContainer');
            wordsContainer.innerHTML = '';
            
            currentWords.forEach(wordData => {
                const wordElement = document.createElement('div');
                wordElement.className = 'word';
                wordElement.setAttribute('draggable', 'true');
                wordElement.setAttribute('id', wordData.id);
                wordElement.setAttribute('data-type', wordData.type);
                wordElement.textContent = wordData.text;
                wordElement.addEventListener('dragstart', dragStart);
                wordsContainer.appendChild(wordElement);
            });
            
            // Reset feedback
            document.getElementById('feedback').textContent = '';
        }
</script>
@endsection

@section('css')
<link rel="stylesheet" href="/assets/css/sortinggame.css">
@endsection

@endsection