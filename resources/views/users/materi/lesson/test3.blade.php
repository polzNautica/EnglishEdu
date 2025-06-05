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
    <div class="customprogress-bar">
	<div class="customprogress-bar-fill"></div>
	<div class="customprogress-step active" data-step="1">🌳</div>
	<div class="customprogress-step" data-step="2">👻</div>
	<div class="customprogress-step" data-step="3">🌙</div>
            </div>

            <!-- Contenu principal -->
            <div class="story-container">
                <!-- SECTION 1: THE BEGINNING OF THE ADVENTURE -->
                <section class="story-section" id="section1">
                    <div class="text-block">
                        <h2>The Beginning of the Adventure</h2>
                        <p>In a distant kingdom, bordered by ancient oaks and morning mist, lay the Enchanted Forest. It was
                            said that deep within its depths lay a millennial secret, guarded by ancient spirits.</p>
                        <button class="next-section-btn">Continue the story</button>
                    </div>
                    <div class="image-block">
                        <img src="https://raw.githubusercontent.com/mickaellherminez/img/main/codepen/january-week1/image-1.png" alt="Illustration of the Enchanted Forest" class="image-placeholder" />
                    </div>
                </section>

                <!-- SECTION 2: THE MYSTERIOUS CREATURE -->
                <section class="story-section" id="section2">
                    <div class="text-block">
                        <h2>The Mysterious Creature</h2>
                        <p>As the trees thickened and the light grew scarce, a silhouette appeared. It was said that this
                            creature watched over the balance of the forest, protecting all living beings from a forgotten evil.
                        </p>
                        <button class="next-section-btn">Discover the next part</button>
                    </div>
                    <div class="image-block">
                        <img src="https://raw.githubusercontent.com/mickaellherminez/img/main/codepen/january-week1/image-2.png" alt="Illustration of the mythical creature" class="image-placeholder" />
                    </div>
                </section>

                <!-- SECTION 3: THE ULTIMATE CHALLENGE -->
                <section class="story-section" id="section3">
                    <div class="text-block">
                        <h2>The Ultimate Challenge</h2>
                        <p>Guided by unexpected courage, the adventurer prepared to break the curse that lay upon these lands.
                            The fate of the Enchanted Forest now rested in their hands.</p>
                    </div>
                    <div class="image-block">
                        <img src="https://raw.githubusercontent.com/mickaellherminez/img/main/codepen/january-week1/image-3.png" alt="Illustration of the final ritual" class="image-placeholder" />
                    </div>
                </section>
            </div>

            <!-- Modal -->
            <div class="modal-overlay">
                <img class="modal-image" src="" alt="Image en grand">
                <div class="modal-close"><span>×</span></div>
            </div>
  </div>
</div>

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script>
    gsap.registerPlugin(ScrollTrigger);

// 1) Sélection des éléments
const sections = document.querySelectorAll(".story-section");
const customprogressBar = document.querySelector(".customprogress-bar-fill");
const steps = document.querySelectorAll(".customprogress-step");

// 2) Position de départ : opacity:0, hors champ pour chaque textBlock et imageBlock
sections.forEach((section) => {
	const textBlock = section.querySelector(".text-block");
	const imageBlock = section.querySelector(".image-block");
	gsap.set(textBlock, { opacity: 0, y: 30 });
	gsap.set(imageBlock, { opacity: 0, x: 30 });
});

// 3) Fonction de mise à jour de la customprogress bar + steps
function updatecustomProgress(index, customprogress) {
	// Calcul : on peut moduler selon le nombre de sections
	const customprogressWidth = (index + customprogress) * (100 / (sections.length - 1));
	customprogressBar.style.width = `${customprogressWidth}%`;

	steps.forEach((step, i) => {
		if (i <= index) {
			step.classList.add("active");
		} else {
			step.classList.remove("active");
		}
	});
}

// 4) Animation de chaque section
sections.forEach((section, index) => {
	const textBlock = section.querySelector(".text-block");
	const imageBlock = section.querySelector(".image-block");

	// Pour la première section, on la joue immédiatement
	if (index === 0) {
		gsap
			.timeline()
			.to(section, {
				// Optionnel si on veut animer le conteneur
				opacity: 1,
				duration: 0.5,
				ease: "power2.out"
			})
			.to(
				textBlock,
				{
					opacity: 1,
					y: 0,
					duration: 0.5,
					ease: "power2.out"
				},
				"-=0.3"
			)
			.to(
				imageBlock,
				{
					opacity: 1,
					x: 0,
					duration: 0.5,
					ease: "power2.out"
				},
				"-=0.3"
			);

		// Les suivantes, via ScrollTrigger
	} else {
		gsap
			.timeline({
				scrollTrigger: {
					trigger: section,
					start: "top 60%",
					end: "bottom 40%",
					toggleActions: "play reverse play reverse"
					// ou "play none none none" si tu ne veux pas de reverse
				}
			})
			.fromTo(
				section,
				{ opacity: 0 },
				{
					opacity: 1,
					duration: 0.5,
					ease: "power2.out"
				}
			)
			.fromTo(
				textBlock,
				{ opacity: 0, y: 30 },
				{
					opacity: 1,
					y: 0,
					duration: 0.5,
					ease: "power2.out"
				},
				"-=0.3"
			)
			.fromTo(
				imageBlock,
				{ opacity: 0, x: 30 },
				{
					opacity: 1,
					x: 0,
					duration: 0.5,
					ease: "power2.out"
				},
				"-=0.3"
			);
	}
});

// 5) Gestion du scroll global (pour la customprogress bar)
window.addEventListener("scroll", () => {
	const docHeight = document.documentElement.scrollHeight - window.innerHeight;
	const scrollPercentage = (window.scrollY / docHeight) * 100;
	const customprogressWidth = Math.min(100, Math.max(0, scrollPercentage));
	customprogressBar.style.width = `${customprogressWidth}%`;

	const currentSection = Math.floor(scrollPercentage / (100 / sections.length));
	steps.forEach((step, i) => {
		if (i <= currentSection) {
			step.classList.add("active");
		} else {
			step.classList.remove("active");
		}
	});

	// Sauvegarder la position pendant le défilement
	saveScrollPosition();
});

// 6) Boutons "suivant" (pour défiler aux sections suivantes)
document.querySelectorAll(".next-section-btn").forEach((btn, index) => {
	btn.addEventListener("click", () => {
		if (index < sections.length - 1) {
			sections[index + 1].scrollIntoView({ behavior: "smooth" });
		}
	});
});

// 7) Gestion des thèmes / background
function applyTheme(sectionIndex) {
	const body = document.body;
	if (sectionIndex === 0) {
		body.classList.add("light-theme");
		body.classList.remove("dark-theme", "sunset-theme");
	} else if (sectionIndex === 1) {
		body.classList.add("sunset-theme");
		body.classList.remove("light-theme", "dark-theme");
	} else if (sectionIndex === 2) {
		body.classList.add("dark-theme");
		body.classList.remove("light-theme", "sunset-theme");
	}
}

document.addEventListener("DOMContentLoaded", function () {
	applyTheme(0);
});

sections.forEach((section, index) => {
	ScrollTrigger.create({
		trigger: section,
		start: "top center",
		end: "bottom center",
		onEnter: () => applyTheme(index),
		onEnterBack: () => applyTheme(index)
	});
});

// 8) customProgress steps (click) => navigation + thème
steps.forEach((step, index) => {
	step.addEventListener("click", () => {
		sections[index].scrollIntoView({ behavior: "smooth" });
		applyTheme(index);
		steps.forEach((s, i) => {
			if (i <= index) s.classList.add("active");
			else s.classList.remove("active");
		});
	});
});

// 9) Modal (zoom image)
const modalOverlay = document.querySelector(".modal-overlay");
const modalImage = document.querySelector(".modal-image");
const modalClose = document.querySelector(".modal-close");

document.querySelectorAll(".image-placeholder").forEach((img) => {
	img.addEventListener("click", () => {
		modalImage.src = img.src;
		modalOverlay.style.display = "flex";
		gsap
			.timeline()
			.to(modalOverlay, {
				opacity: 1,
				duration: 0.3,
				ease: "power2.out"
			})
			.to(
				modalImage,
				{
					scale: 1,
					opacity: 1,
					duration: 0.5,
					ease: "back.out(1.7)"
				},
				"-=0.1"
			)
			.to(
				modalClose,
				{
					opacity: 1,
					rotation: 0,
					duration: 0.3,
					ease: "power2.out"
				},
				"-=0.3"
			);
	});
});

function closeModal() {
	gsap
		.timeline()
		.to(modalClose, {
			opacity: 0,
			rotation: -180,
			duration: 0.3,
			ease: "power2.in"
		})
		.to(
			modalImage,
			{
				scale: 0.8,
				opacity: 0,
				duration: 0.3,
				ease: "power2.in"
			},
			"-=0.2"
		)
		.to(
			modalOverlay,
			{
				opacity: 0,
				duration: 0.3,
				ease: "power2.in",
				onComplete: () => {
					modalOverlay.style.display = "none";
				}
			},
			"-=0.2"
		);
}

modalClose.addEventListener("click", closeModal);
modalOverlay.addEventListener("click", (e) => {
	if (e.target === modalOverlay) {
		closeModal();
	}
});

// 10) Sauvegarde / restauration de la position de scroll
function saveScrollPosition() {
	localStorage.setItem("scrollPosition", window.scrollY);
	const currentSection = Math.floor(
		(window.scrollY /
			(document.documentElement.scrollHeight - window.innerHeight)) *
			sections.length
	);
	localStorage.setItem("currentSection", currentSection);
}

function restoreScrollPosition() {
	const savedPosition = localStorage.getItem("scrollPosition");
	const savedSection = localStorage.getItem("currentSection");
	if (savedPosition !== null) {
		window.scrollTo(0, parseInt(savedPosition));
		if (savedSection !== null) {
			applyTheme(parseInt(savedSection));
		}
	}
}

// Sauvegarder la position avant rechargement
window.addEventListener("beforeunload", saveScrollPosition);

// Restaurer la position après chargement
document.addEventListener("DOMContentLoaded", function () {
	restoreScrollPosition();

	// Mise à jour initiale de la barre de customprogression
	const docHeight = document.documentElement.scrollHeight - window.innerHeight;
	const scrollPercentage = (window.scrollY / docHeight) * 100;
	const customprogressWidth = Math.min(100, Math.max(0, scrollPercentage));
	customprogressBar.style.width = `${customprogressWidth}%`;

	// Mise à jour des boutons actifs
	const currentSection = Math.floor(scrollPercentage / (100 / sections.length));
	steps.forEach((step, i) => {
		if (i <= currentSection) {
			step.classList.add("active");
		} else {
			step.classList.remove("active");
		}
	});
});

</script>
@endsection

@section('css')
<style>
    * {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

body {
	font-family: "Helvetica Neue", sans-serif;
	line-height: 1.6;
	color: #333;
	overflow-x: hidden;
	transition: background-color 0.5s ease, color 0.5s ease;
	background-color: #f5f5f5;
}

.story-container {
	max-width: 1400px;
	margin: 0 auto;
	padding: 2rem;
}

/* On NE met plus opacity:0 sur .story-section */
.story-section {
	display: flex;
	justify-content: center;
	align-items: center;
	min-height: 100vh;
	padding: 4rem;
	gap: 6rem;
	max-width: 1600px;
	margin: 0 auto;
}

.text-block {
	flex: 0.8;
	max-width: 600px;
	padding: 3.5rem;
	background: rgba(255, 255, 255, 0.97);
	border-radius: 25px;
	box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
	margin: 1rem;
	-webkit-backdrop-filter: blur(10px);
	backdrop-filter: blur(10px);
	transform-origin: center center;
	letter-spacing: 0.3px;
	/* sera animé par GSAP */
}

.image-block {
	flex: 1;
	display: flex;
	justify-content: center;
	align-items: center;
	/* sera animé par GSAP */
}

.image-placeholder {
	width: 100%;
	max-width: 500px;
	height: auto;
	object-fit: cover;
	border-radius: 20px;
	box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
	transition: transform 0.3s ease;
}

.image-placeholder:hover {
	transform: scale(1.02);
}

.customprogress-bar {
	position: fixed;
	bottom: 40px;
	left: 50%;
	transform: translateX(-50%);
	width: 300px;
	height: 4px;
	z-index: 1000;
	display: flex;
	justify-content: space-between;
	align-items: center;
	padding: 0;
}

.customprogress-bar-fill {
	position: absolute;
	top: 50%;
	left: 20px;
	width: calc(100% - 40px);
	max-width: calc(100% - 40px);
	height: 4px;
	background: linear-gradient(90deg, #f39c12, #f1c40f);
	transform: translateY(-50%);
	z-index: 1;
	border-radius: 10px;
	transition: width 0.3s ease;
}

/* Ligne de fond de la barre */
.customprogress-bar::before {
	content: "";
	position: absolute;
	top: 50%;
	left: 20px;
	width: calc(100% - 40px);
	height: 4px;
	background: rgba(0, 0, 0, 0.1);
	transform: translateY(-50%);
	border-radius: 10px;
	z-index: 0;
}

.customprogress-step {
	width: 40px;
	height: 40px;
	background: #fff;
	border-radius: 50%;
	display: flex;
	justify-content: center;
	align-items: center;
	font-size: 20px;
	color: #333;
	position: relative;
	z-index: 2;
	transition: all 0.3s ease;
	box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
	border: 2px solid #fff;
	margin-top: -18px;
	cursor: pointer;
}

.customprogress-step:hover {
	transform: scale(1.1);
	box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
}

.customprogress-step.active {
	background: #f39c12;
	color: #fff;
	transform: scale(1.1);
	border-color: #fff;
}

h2 {
	font-size: 2.8rem;
	color: #2c3e50;
	margin-bottom: 2rem;
	font-weight: 700;
	letter-spacing: -0.5px;
}

p {
	font-size: 1.2rem;
	line-height: 1.9;
	margin-bottom: 2.5rem;
	color: #4a5568;
	font-weight: 400;
}

.next-section-btn {
	display: inline-block;
	padding: 1rem 2rem;
	background: #333;
	color: white;
	border: none;
	border-radius: 30px;
	cursor: pointer;
	font-size: 1.1rem;
	margin-top: 2rem;
	transition: all 0.3s ease;
	box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.next-section-btn:hover {
	background: #555;
	transform: translateY(-3px);
	box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Thèmes */
.light-theme {
	background-color: #f4f4f9;
	color: #333;
}

.dark-theme {
	background-color: #2c3e50;
	color: #f4f4f9;
}

/* Thème intermédiaire */
.mid-theme {
	background-color: #3e4a61;
	color: #e0e0e0;
}

/* Thème coucher de soleil */
.sunset-theme {
	background-color: #f39c12;
	color: #fff;
}

.modal-overlay {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(0, 0, 0, 0.9);
	display: none;
	justify-content: center;
	align-items: center;
	z-index: 2000;
	opacity: 0;
	backdrop-filter: blur(8px);
	-webkit-backdrop-filter: blur(8px);
}

.modal-image {
	max-width: 90%;
	max-height: 90vh;
	border-radius: 20px;
	box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
	transform: scale(0.8);
	opacity: 0;
	cursor: pointer;
}

.modal-close {
	position: fixed;
	top: 30px;
	right: 30px;
	width: 50px;
	height: 50px;
	background: rgba(255, 255, 255, 0.2);
	border: 2px solid rgba(255, 255, 255, 0.4);
	border-radius: 50%;
	display: flex;
	justify-content: center;
	align-items: center;
	cursor: pointer;
	font-size: 28px;
	color: white;
	opacity: 0;
	transform: rotate(-180deg);
	transition: all 0.3s ease;
	backdrop-filter: blur(5px);
	-webkit-backdrop-filter: blur(5px);
}

.modal-close span {
	display: block;
	transform: translateY(-2px);
}

.modal-close:hover {
	transform: rotate(0deg) scale(1.1);
	background: rgba(255, 255, 255, 0.3);
	border-color: rgba(255, 255, 255, 0.6);
	box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
}

/* Styles responsives */
@media screen and (max-width: 1200px) {
	.story-section {
		padding: 2rem;
		gap: 3rem;
	}
	.text-block {
		padding: 2rem;
	}
	h2 {
		font-size: 2.2rem;
	}
	p {
		font-size: 1.1rem;
	}
}

@media screen and (max-width: 900px) {
	.story-section {
		flex-direction: column;
		padding: 1rem;
		gap: 2rem;
		min-height: auto;
		margin: 4rem 0;
	}
	.text-block {
		flex: 1;
		width: 100%;
		max-width: 100%;
		order: 2;
	}
	.image-block {
		flex: 1;
		width: 100%;
		order: 1;
	}
	.image-placeholder {
		max-width: 100%;
		height: auto;
	}
	.customprogress-bar {
		width: 250px;
		bottom: 40px;
	}
	.customprogress-step {
		width: 35px;
		height: 35px;
		font-size: 16px;
	}
}

@media screen and (max-width: 600px) {
	.story-container {
		padding: 1rem;
	}
	.text-block {
		padding: 1.5rem;
	}
	h2 {
		font-size: 1.8rem;
		margin-bottom: 1.5rem;
	}
	p {
		font-size: 1rem;
		line-height: 1.7;
		margin-bottom: 2rem;
	}
	.next-section-btn {
		padding: 0.8rem 1.6rem;
		font-size: 1rem;
	}
	.customprogress-bar {
		width: 200px;
	}
	.customprogress-step {
		width: 30px;
		height: 30px;
		font-size: 14px;
		margin-top: -13px;
	}
	.modal-close {
		top: 15px;
		right: 15px;
		width: 40px;
		height: 40px;
		font-size: 24px;
	}
}

@media screen and (max-width: 400px) {
	.customprogress-bar {
		width: 180px;
	}
	.customprogress-step {
		width: 25px;
		height: 25px;
		font-size: 12px;
		margin-top: -10px;
	}
	h2 {
		font-size: 1.6rem;
	}
	.text-block {
		padding: 1.2rem;
	}
}

</style>
@endsection

@endsection
