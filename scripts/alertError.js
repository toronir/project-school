import React, { useRef, useState } from "react";
import { Alert, Button } from "react-bootstrap";

//Alert on error submite


const AlertDismissibleExample = () => {
    const [show, setShow] = useState(true);


    return (
        <Alert variant="danger" onClose={() => setShow(false)} >
            <Alert.Heading>
                O nie! Masz błąd!
            </Alert.Heading>
            <p>

                Ten e-mail jest już zarejestrowany lub oczekuje na zatwierdzenie. Podaj inny adres e-mail lub sprawdź pocztę
            </p>
        </Alert>
    );
}




export default AlertDismissibleExample;