import React, { useRef, useState } from "react";
import { Alert, Button } from "react-bootstrap";


//Alert on success submite

const AlertDismissible = ({user_mail}) => {

    const [show, setShow] = useState(true);

    return (
        <>
            <Alert show={show} variant="success">
                <Alert.Heading>Hurra! Wszystko poszło dobrze!</Alert.Heading>
                <p>
                    E-mail został wysłany na adres {user_mail} . Proszę czekać na akceptację administratora
                </p>
                <hr />

            </Alert>


        </>
    );
}



export default AlertDismissible;