// FIELDS
const pic = document.getElementById('pic');
const picOriginal = pic.value;
const givenName = document.getElementById('given_name');
const givenNameOriginal = givenName.value;
const familyName = document.getElementById('family_name');
const familyNameOriginal = familyName.value;
const dob = document.getElementById('dob');
const dobOriginal = dob.value;

// PICS
const newPicContainer = document.getElementById('new-pic-container');
const newPic = document.getElementById('new-pic');

const userId = document.getElementById('user_id').value;
const removeProfilePicBtn = document.getElementById('remove-pic');
const removePicBtnContainer = document.getElementById('remove-pic-btn-container');
const currentPicContainer = document.getElementById('current-pic-container');

const currentPicImg = document.getElementById('pic-img');
const originalPicSrc = currentPicImg.getAttribute('src');

const currentPicTxt = document.querySelector('label[for="pic"]');
const originalPicTxt = currentPicTxt.textContent;

document.addEventListener('DOMContentLoaded', function() {
    if (!currentPicImg.getAttribute('src')) {
        currentPicContainer.style.display = 'none';
    }

    pic.addEventListener('change', function(e) {
        if (!e.target.value) {
            newPic.setAttribute('src', '');
            newPic.setAttribute('alt', '');
            newPicContainer.style.display = 'none';
        }
        else {
            const reader = new FileReader();

            reader.onload = e => {
                newPic.setAttribute('src', e.target.result);
                newPic.setAttribute('alt', 'New profile picture');
                newPicContainer.style.display = 'block';
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
});

const restore = document.getElementById('restore');

restore.addEventListener('click', function (e) {
    e.preventDefault();
    pic.value = picOriginal;
    newPic.setAttribute('src', '');
    newPic.setAttribute('alt', '');
    givenName.value = givenNameOriginal;
    familyName.value = familyNameOriginal;
    dob.value = dobOriginal;
});

removeProfilePicBtn.addEventListener('click', async function (e) {
    e.preventDefault();

    // send PUT request to mark profile pic for removal
    if (e.target.textContent === 'Undo') {
        const response = await toggleProfilePic(false);

        if (response.status === 200) {
            toggleProfileImg(false);
        }
    }
    else {
        const response = await toggleProfilePic(true);

        if (response.status === 200) {
            toggleProfileImg(true);
        }
    }

});

/**
 * Toggles a profile pic (i.e. either marks for removal or undoes the operation)
 * @param {boolean} toggle
 * @returns {Promise<{remove_pic: boolean|null, status: number}>}
 */
async function toggleProfilePic(toggle) {
    // send PUT request to mark profile pic for removal
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const response = await fetch(`/profiles/${userId}/toggle_pic`, {
        method: 'PUT',
        credentials: 'include',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({
            'user_id': userId,
            'remove_pic': toggle
        })
    });

    let parsedResponse;

    try {
        parsedResponse = await response.json();
        return parsedResponse;
    }
    catch(e) {
        console.log('Could not parse server response');
        console.dir(e);

        return {
            remove_pic: null,
            status: response.status
        }
    }
}

/**
 * Removes or restores the current profile pic in the DOM
 * @param {boolean} remove
 */
function toggleProfileImg(remove) {
    if (remove) {
        removeProfilePicBtn.textContent = 'Undo'
        removeProfilePicBtn.classList.remove('btn-danger');
        removeProfilePicBtn.classList.add('btn-warning');

        currentPicImg.setAttribute('src', '');
        currentPicImg.setAttribute('alt', '');

        currentPicTxt.textContent = 'Current profile picture: removed';
    }
    else {
        removeProfilePicBtn.textContent = 'Remove profile picture'
        removeProfilePicBtn.classList.add('btn-danger');
        removeProfilePicBtn.classList.remove('btn-warning');

        currentPicImg.setAttribute('src', originalPicSrc);
        currentPicImg.setAttribute('alt', 'Profile picture');

        currentPicTxt.textContent = originalPicTxt;
    }
}
