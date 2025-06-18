@extends('layouts.main.index')
 
@section('container')
  <div class="container">
        {{-- Back Button --}}
  <div class="mb-3">
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
    ← Back
    </a>
  </div>
  <div class="card shadow-sm overflow-auto">
        <div class="image-indicators">
        <input type="checkbox" class="point" id="point-1" name="point" value="1">
        <input type="checkbox" class="point" id="point-2" name="point" value="2">
        <input type="checkbox" class="point" id="point-3" name="point" value="3">
        <input type="checkbox" class="point" id="point-4" name="point" value="4">
        <input type="checkbox" class="point" id="point-5" name="point" value="5">
        <input type="checkbox" class="point" id="point-6" name="point" value="6">
        <input type="checkbox" class="point" id="point-7" name="point" value="7">
        <input type="checkbox" class="point" id="point-8" name="point" value="8">
        <input type="checkbox" class="point" id="point-9" name="point" value="9">
        <input type="checkbox" class="point" id="point-10" name="point" value="10">
        <input type="checkbox" class="point" id="point-11" name="point" value="11">

        <label for="point-1" id="label-1" >
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-2" id="label-2" >
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-3" id="label-3">
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-4" id="label-4">
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-5" id="label-5">
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-6" id="label-6">
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-7" id="label-7">
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-8" id="label-8">
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-9" id="label-9">
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-10" id="label-10">
            <span>
                <span></span>
            </span>
        </label>
        <label for="point-11" id="label-11">
            <span>
                <span></span>
            </span>
        </label>
        <div class="description" style="margin-top: 20px;">
            <div >
                <p>Click any button below to see description</p>
                <!-- <p>La peste à la Tourette représentant le chevalier Roze et les échevins, huile sur toile, 1755, collection Musée d'Histoire de Marseille.</p> -->
            </div>
            <div>
                <p>The mother and child played together on the carpet.</p>
            </div>
            <div>
                <p>Three people practiced karate together.</p>
            </div>
            <div>
                <p>She walked her dog along the path.</p>
            </div>
            <div>
                <p>The woman waved as she passed by.</p>
            </div>
            <div>
                <p>He sat quietly on a bench by the path.</p>
            </div>
            <div>
                <p>The ducks swam in the pond.</p>
            </div>
            <div>
                <p>The girl read a book on the bench.</p>
            </div>
            <div>
                <p>She rode a bicycle past the pond.</p>
            </div>
            <div>
                <p>Two people talked on the bench near the fountain.</p>
            </div>
            <div>
                <p>They ran together through the open field.</p>
            </div>
            <div>
                <p>He rode a scooter near the benches.</p>
            </div>

        </div>
                <img src="\assets\img\lesson-images\6237978017872746004.jpg" >

    </div>

  </div>

  </div>
@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.point');
    let currentUtterance = null;
    let voices = [];
    
    // Load available voices
    function loadVoices() {
        voices = window.speechSynthesis.getVoices();
        
        // This event fires when voices are loaded/changed
        speechSynthesis.onvoiceschanged = function() {
            voices = window.speechSynthesis.getVoices();
        };
    }
    
    // Function to stop any currently playing speech
    function stopCurrentSpeech() {
        if (window.speechSynthesis.speaking) {
            window.speechSynthesis.cancel();
        }
    }
    
    // Function to get all text from a description div
    function getDescriptionText(div) {
        return Array.from(div.querySelectorAll('p'))
            .map(p => p.textContent.trim())
            .filter(text => text.length > 0)
            .join('. ');
    }
    
    // Function to find a female voice
    function findFemaleVoice() {
        // Try to find a female voice (different browsers use different properties)
        const femaleVoices = voices.filter(voice => {
            // Different browsers indicate gender differently
            return voice.name.includes('Female') || 
                   voice.name.includes('Woman') ||
                   voice.name.includes('Zira') || // Microsoft female voice
                   voice.name.includes('Samantha') || // Apple female voice
                   (voice.voiceURI && voice.voiceURI.includes('Female'));
        });
        
        // Return the first female voice found, or default voice if none found
        return femaleVoices.length > 0 ? femaleVoices[0] : voices[0];
    }
    
    // Function to speak text with female voice
    function speakText(text) {
        stopCurrentSpeech();
        
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.rate = 0.9;
        utterance.pitch = 1;
        utterance.lang = 'en-US';
        
        // Set female voice if available
        if (voices.length > 0) {
            const femaleVoice = findFemaleVoice();
            if (femaleVoice) {
                utterance.voice = femaleVoice;
            }
        }
        
        window.speechSynthesis.speak(utterance);
        currentUtterance = utterance;
    }
    
    // Initialize voices when page loads
    loadVoices();
    
    // Handle checkbox changes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                const pointNumber = this.value;
                const descriptionDiv = document.querySelector(
                    `#point-${pointNumber}:checked ~ .description div:nth-child(${Number(pointNumber)+1})`
                );
                
                if (descriptionDiv) {
                    const textToSpeak = getDescriptionText(descriptionDiv);
                    speakText(textToSpeak);
                }
            } else {
                stopCurrentSpeech();
            }
        });
    });
    
    // Stop speech when clicking outside (optional)
    document.addEventListener('click', function(e) {
        if (!e.target.classList.contains('point')) {
            const anyChecked = Array.from(checkboxes).some(cb => cb.checked);
            if (!anyChecked) {
                stopCurrentSpeech();
            }
        }
    });
    
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            stopCurrentSpeech();
        }
    });
});
</script>
@endsection

@section('css')
@vite(['resources/js/app.js'])
<style>
    :root {
    --point-1-top: 455px;
    --point-1-left: 319px;
    --point-2-top: 264px;
    --point-2-left: 123px;
    --point-3-top: 597px;
    --point-3-left: 268px;
    --point-4-top: 487px;
    --point-4-left: 506px;
    --point-5-top: 342px;
    --point-5-left: 421px;
    --point-6-top: 405px;
    --point-6-left: 145px;
    --point-7-top: 498px;
    --point-7-left: 107px;
    --point-8-top: 332px;
    --point-8-left: 200px;
    --point-9-top: 275px;
    --point-9-left: 245px;
    --point-10-top: 245px;
    --point-10-left: 371px;
    --point-11-top: 301px;
    --point-11-left: 379px;
    --point-width: 15px;
    --point-height: 15px;
    --point-1-scale: 2;
    --point-2-scale: 2;
    --point-3-scale: 2;
    --point-4-scale: 2;
    --point-5-scale: 2;
    --point-6-scale: 2;
    --point-7-scale: 2;
    --point-8-scale: 2;
    --point-9-scale: 2;
    --point-10-scale: 2;
    --point-11-scale: 2;
}

.image-indicators {
    position: relative;
    width: 600px;
    border-radius: 10px;
    overflow: hidden;
    font-size: 0;
    margin: auto;
    margin-bottom: 2rem;
    margin-top: 2rem;
    cursor: pointer;
    transition: transform 0.3s ease;
}

</style>
@endsection

@endsection