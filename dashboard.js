document.getElementById("searchInput").addEventListener("input", function () {
    const searchValue = this.value.toLowerCase().trim();

    fetch(`search-doctor.php?name=${searchValue}`)
        .then((response) => response.json())
        .then((data) => {
            if (data.length > 0) {
                let doctor = data[0];
                alert(
                    `Doctor Found:\n\nName: ${doctor.name}\nSpecialty: ${doctor.specialty}\nEmail: ${doctor.email}\nContact: ${doctor.contact_number}`
                );
            } else {
                alert("No doctor found.");
            }
        });
});

const toggle = document.querySelector('.toggle');
const navigation = document.querySelector('.navigation');
const main = document.querySelector('.main');

toggle.addEventListener('click', () => {
  navigation.classList.toggle('active'); // Toggles the active state for navigation
  main.classList.toggle('active'); // Adjusts main content margin
});


