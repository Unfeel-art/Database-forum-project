checkSignIn = async () => {
    try {
        const res = await fetch('/~achernii/api/signin.php?action=check_signin', {
            method: 'GET',
            credentials: 'include'
        });

        
        const data = await res.json();
        
        return data;
    } catch (err) {
        console.error('Error:', err);
        return {'signedIn' : false};
    }
};

signOut = async () => {
    try {
        const res = await fetch('/~achernii/api/signin.php?action=signout', {
            method: 'GET',
            credentials: 'include'
        });
        
        const data = await res.json();
        
        if (data.success) {
            window.location.href = '/~achernii/index.php';
        } else {
            console.error('Signout error:', data.error);
        }
    } catch (err) {
        console.error('Signout error:', err);
    }
};