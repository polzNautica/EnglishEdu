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
        <div class="description" style="margin-top: 20px;">
            <div >
                <p>Click any button below to see description</p>
                <!-- <p>La peste à la Tourette représentant le chevalier Roze et les échevins, huile sur toile, 1755, collection Musée d'Histoire de Marseille.</p> -->
            </div>
            <div>
                <p>Nam libero tempore, cum soluta nobis est eligendi optio cum</p>
                <p>impedit quo minus id quod maxime placeat facere possimus.</p>
            </div>
            <div>
                <p>Proin nunc sem, pretium vehicula erat vitae, pulvinar fauci</p>
                <p>Curabitur ullamcorper elementum augue, ac tristique lacus </p>
                                <p>eget pretium mauris ligula vel semper.</p>
                <p>eget pretium mauris ligula vel semper.</p>

            </div>
            <div>
                <p>Aliquam euismod, leo nec efficitur aliquet, neque nulla vol</p>
                <p>eget pretium mauris ligula vel semper.</p>
            </div>
            <div>
                <p>Mauris posuere, mauris in ultricies, neque nulla volutpat m</p>
                <p>eget pretium mauris ligula vel semper.</p>
                                <p>eget pretium mauris ligula vel semper.</p>

            </div>
        </div>
                <img src="\assets\img\lesson-images\bdfbf2e559cab05d782f1b8a91ce5aa7.jpg" >

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
@vite(['resources/scss/test2.scss'])
<style>
    :root {
    --point-1-top: 415px;
    --point-1-left: 61px;
    --point-2-top: 276px;
    --point-2-left: 175px;
    --point-3-top: 567px;
    --point-3-left: 323px;
    --point-4-top: 218px;
    --point-4-left: 540px;
    --point-width: 15px;
    --point-height: 15px;
    --point-1-scale: 2;
    --point-2-scale: 2;
    --point-3-scale: 2;
    --point-4-scale: 2;
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