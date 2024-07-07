document.addEventListener('DOMContentLoaded', () => {
    const pages = document.querySelectorAll('.page');
    const links = document.querySelectorAll('.sidebar a');
    const profileForm = document.getElementById('profile-form');
    const profileImg = document.getElementById('profile-img');
    const displayImg = document.getElementById('display-img');
    const profileName = document.getElementById('profile-name');
    const profileGender = document.getElementById('profile-gender');
    const displayName = document.getElementById('display-name');
    const displayGender = document.getElementById('display-gender');

    // Function to show a specific page
    function showPage(id) {
        pages.forEach(page => {
            page.style.display = page.id === id ? 'block' : 'none';
        });
    }

    // Add event listeners to sidebar links
    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const id = link.getAttribute('href').substring(1);
            showPage(id);
        });
    });

    // Handle profile form submission
    profileForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const name = profileName.value;
        const gender = profileGender.value;
        const imgUpload = document.getElementById('profile-img-upload').files[0];

        if (imgUpload) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImg.src = e.target.result;
                displayImg.src = e.target.result;
            }
            reader.readAsDataURL(imgUpload);
        }

        displayName.textContent = name;
        displayGender.textContent = gender.charAt(0).toUpperCase() + gender.slice(1);
        alert('Profil mis à jour : ' + name);
    });

    // Show the first page by default
    showPage('page1');
});
