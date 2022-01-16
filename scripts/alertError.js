import React, { useRef, useState } from "react";
import { Alert, Button } from "react-bootstrap";

//Alert on error submite


const AlertDismissibleExample = () => {
    const [show, setShow] = useState(true);


    return (
        <Alert variant="danger" onClose={() => setShow(false)} >
            <Alert.Heading>Oh snap! You got an error!</Alert.Heading>
            <p>
                Ten e-mail jest już zarejestrowany lub oczekuje na zatwierdzenie. Wpisz inny adres e-mail lub sprawdź pocztęс
            </p>
        </Alert>
    );
}




export default AlertDismissibleExample;