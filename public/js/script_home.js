

document.addEventListener('DOMContentLoaded', () => {
    const offerItems = document.querySelectorAll('.offer-item');
    const selectedOffer = document.querySelector('.selected-offer');
    const jobSearch = document.getElementById('job-search');
    const locationSearch = document.getElementById('location-search');

    jobSearch.addEventListener('input', filterOffers);
    locationSearch.addEventListener('input', filterOffers);


    const firstOffer = document.querySelector('.offer-item');

    (async () => {
        const offerId = firstOffer.dataset.id;
        const offerDetails = await fetchOfferDetails(offerId);

        selectedOffer.innerHTML =  `<div style="padding: 40px; display: flex; align-items: flex-start; justify-content: space-between;">
        <div style="flex: 0 0 300px; background-color: #E6E6E6; padding: 20px;">
            <div style="display: flex; align-items: center; margin-bottom: 20px;">
                <img src="/storage/images/${offerDetails.company.company_name}.png" alt="${offerDetails.company.company_name}" style="height: 80px; width: 80px; margin-right: 10px; ">
                
                <h3 style="font-size: 18px; color: #333333; margin: 0;">${offerDetails.company.company_name}</h3>
            </div>
            <p style="font-size: 16px; color: #666666; margin-bottom: 5px;"><strong>Compétences :</strong></p>
            <ul style="list-style: none; margin: 0; padding: 0;">
                ${offerDetails.skills.split(',').map(skill => `<li style="font-size: 16px; color: #666666; margin-left: 25px;">${skill.trim()}</li>`).join('')}
            </ul>
            <p style="font-size: 16px; color: #666666;"><strong>Type :</strong> ${offerDetails.type}</p>
            <p style="font-size: 16px; color: #666666;"><strong>Durée :</strong> ${offerDetails.duration}</p>
            <p style="font-size: 16px; color: #666666;"><strong>Salaire :</strong> ${offerDetails.salary}</p>
            <p style="font-size: 16px; color: #666666; "><strong>Date :</strong> ${offerDetails.date}</p>
            <p style="font-size: 16px; color: #666666;"><strong>Nombre de places :</strong> ${offerDetails.number}</p>
        </div>
        <div style="flex: 1;max-width: 800px;">
            <h2 style="font-size: 26px; color: #333333; margin-bottom: 20px; text-align: center; margin-left: 5%;">${offerDetails.title}</h2>
            <div style="font-size: 20px; color: #666666; line-height: 1.5; margin-left: 5%; border-left: 2px solid; border-color : #666666; padding-left: 3%">
                ${offerDetails.offer_description}
            </div>
<div style="display: flex; justify-content: flex-end; margin-top: 20px;">
<a href="/apply/${offerDetails.id}" style="background-color: yellow; color: black; padding: 10px 20px; border: none; font-size: 20px; text-decoration: none;">Postuler</a>
            </div>
        </div>
      </div>`;
    })();



    function filterOffers() {
        const jobSearchValue = jobSearch.value.toLowerCase();
        const locationSearchValue = locationSearch.value.toLowerCase();
        const noResults = document.querySelector('.no-results');
        let resultsFound = false;

        offerItems.forEach(offerItem => {
            const offerTitle = offerItem.querySelector('h3').textContent.toLowerCase();
            const offerCity = offerItem.querySelector('p:last-child').textContent.toLowerCase();

            if (offerTitle.includes(jobSearchValue) && offerCity.includes(locationSearchValue)) {
                offerItem.style.display = 'flex';
                resultsFound = true;
            } else {
                offerItem.style.display = 'none';
            }
        });

        if (resultsFound) {
            noResults.style.display = 'none';
        } else {
            noResults.style.display = 'block';
        }
    }

    offerItems.forEach(offerItem => {
      offerItem.addEventListener('click', async () => {
        const offerId = offerItem.dataset.id;
        const offerDetails = await fetchOfferDetails(offerId);

        // Check if device is a phone
        const isPhone = window.matchMedia('(max-width: 767px)').matches;

        if (isPhone) {
                window.location.href = '/offers/' + offerId;
        } else {
          selectedOffer.innerHTML =  `<div style="padding: 40px; display: flex; align-items: flex-start; justify-content: space-between;">
            <div style="flex: 0 0 300px; background-color: #E6E6E6; padding: 20px;">
                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                    <img src="/storage/images/${offerDetails.company.company_name}.png" alt="${offerDetails.company.company_name}" style="height: 80px; width: 80px; margin-right: 10px; ">
                    
                    <h3 style="font-size: 18px; color: #333333; margin: 0;">${offerDetails.company.company_name}</h3>
                </div>
                <p style="font-size: 16px; color: #666666; margin-bottom: 5px;"><strong>Compétences :</strong></p>
                <ul style="list-style: none; margin: 0; padding: 0;">
                    ${offerDetails.skills.split(',').map(skill => `<li style="font-size: 16px; color: #666666; margin-left: 25px;">${skill.trim()}</li>`).join('')}
                </ul>
                <p style="font-size: 16px; color: #666666;"><strong>Type :</strong> ${offerDetails.type}</p>
                <p style="font-size: 16px; color: #666666;"><strong>Durée :</strong> ${offerDetails.duration}</p>
                <p style="font-size: 16px; color: #666666;"><strong>Salaire :</strong> ${offerDetails.salary}</p>
                <p style="font-size: 16px; color: #666666; "><strong>Date :</strong> ${offerDetails.date}</p>
                <p style="font-size: 16px; color: #666666;"><strong>Nombre de places :</strong> ${offerDetails.number}</p>
            </div>
            <div style="flex: 1;max-width: 800px;">
                <h2 style="font-size: 26px; color: #333333; margin-bottom: 20px; text-align: center; margin-left: 5%;">${offerDetails.title}</h2>
                <div style="font-size: 20px; color: #666666; line-height: 1.5; margin-left: 5%; border-left: 2px solid; border-color : #666666; padding-left: 3%">
                    ${offerDetails.offer_description}
                </div>
    <div style="display: flex; justify-content: flex-end; margin-top: 20px;">
    <a href="/apply/${offerDetails.id}" style="background-color: yellow; color: black; padding: 10px 20px; border: none; font-size: 20px; text-decoration: none;">Postuler</a>
                </div>
            </div>
          </div>`;
        }
      });
    });

    async function fetchOfferDetails(offerId) {
        try {
            const response = await fetch(`/api/offers/${offerId}`);
            const offerDetails = await response.json();
            return offerDetails;
        } catch (error) {
            console.error('Erreur lors de la récupération des détails de l\'offre:', error);
            return null;
        }
    }
});