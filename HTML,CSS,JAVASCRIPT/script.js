document.getElementById('registrationForm').addEventListener('submit', function (event) {
    event.preventDefault();
    let isValid = true;
    const nameField = document.getElementById('name');
    const emailField = document.getElementById('email');
    const ageField = document.getElementById('age');
    const descriptionField = document.getElementById('description');
    const periodField = document.getElementById('historicalPeriod');
    const researchMethodField = document.getElementById('researchMethod');
    const historicalInterestField = document.getElementById('historicalInterest');
    const historicalResearchField = document.getElementById('historicalResearch');
    const favoriteHistoricalFigureField = document.getElementById('favoriteHistoricalFigure');
    const historicalArtifactField = document.getElementById('historicalArtifact');
    const historicalWorkField = document.getElementById('historicalWork');
    clearAlert('nameAlert');
    clearAlert('emailAlert');
    clearAlert('ageAlert');
    clearAlert('descriptionAlert');
    clearAlert('periodAlert');
    clearAlert('researchMethodAlert');
    clearAlert('interestAlert');
    clearAlert('researchAlert');
    clearAlert('figureAlert');
    clearAlert('artifactAlert');
    clearAlert('workAlert');
    const nameRegex = /^[A-Za-z\s]+$/;
    if (!nameRegex.test(nameField.value.trim())) {
        showAlert('nameAlert', 'Name must contain only letters.');
        isValid = false;
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailField.value.trim())) {
        showAlert('emailAlert', 'Please enter a valid email address.');
        isValid = false;
    }
    if (ageField.value < 18 || ageField.value > 100) {
        showAlert('ageAlert', 'Age must be between 18 and 100.');
        isValid = false;
    }
    if (descriptionField.value.trim().length < 20) {
        showAlert('descriptionAlert', 'Description must be at least 20 characters long.');
        isValid = false;
    }
    if (periodField.value === "") {
        showAlert('periodAlert', 'Please select a historical period.');
        isValid = false;
    }
    if (researchMethodField.value === "") {
        showAlert('researchMethodAlert', 'Please select a research method.');
        isValid = false;
    }
    if (historicalInterestField.value.trim().length > 100) {
        showAlert('interestAlert', 'Area of interest must be within 100 characters.');
        isValid = false;
    }
    if (historicalWorkField.value.trim().length > 100) {
        showAlert('workAlert', 'Previous work must be within 100 characters.');
        isValid = false;
    }
    if (historicalResearchField.value === "") {
        showAlert('researchAlert', 'Please select if you have conducted formal research.');
        isValid = false;
    }
    if (!nameRegex.test(favoriteHistoricalFigureField.value.trim()) || favoriteHistoricalFigureField.value.trim().length > 50) {
        showAlert('figureAlert', 'Please enter a valid historical figure (letters only, max 50 characters).');
        isValid = false;
    }
    if (historicalArtifactField.value.trim().length > 50) {
        showAlert('artifactAlert', 'Favorite artifact must be within 50 characters.');
        isValid = false;
    }
    if (isValid) {
        window.location.href = "https://www.thehistoryblog.com/";
    }
});
function showAlert(id, message) {
    const alertElement = document.getElementById(id);
    alertElement.textContent = message;
    alertElement.style.display = 'block';
}
function clearAlert(id) {
    const alertElement = document.getElementById(id);
    alertElement.textContent = '';
    alertElement.style.display = 'none';
}
