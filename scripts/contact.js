import React, { useRef, useState } from "react";
import bootstrap from "bootstrap";
import { Button, Form, Alert } from "react-bootstrap";
import AlertDismissible from "./alertSuccess.js";
import AlertDismissibleExample from "./alertError.js";



const Contact = () => {
    const inputEmailRef = useRef();
    const inputNameRef = useRef();
    const inputPhoneRef = useRef();
    const inputBirthdayRef = useRef();
    const [validated, setValidated] = useState(false);
    const [backEndResp, setBackEndResp] = useState("");


    const handleSubmit = (event) => {
        const form = event.currentTarget;
        if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }

        setValidated(true);
    };


    const submitHandler = async (event) => {
        event.preventDefault();
        const form = event.currentTarget;

        const email = inputEmailRef.current.value;
        const name = inputNameRef.current.value;
        const phone = inputPhoneRef.current.value;
        const birthday = inputBirthdayRef.current.value;
        console.log(form.checkValidity());
        if (email && form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();


            const response = await fetch(`${page.api_url}work-on/contact`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ email: email, name: name, phone: phone, birthday: birthday, })

            });

            const responseData = await response.json();


            switch (responseData) {
                case "success":
                    setBackEndResp("success")
                    break;
                case "user_exists":
                    setBackEndResp("user_exists")
                    break;
                // case "error":
                //     alert("Coś poszło nie tak")
                //     break;



                default:
                    alert("Unknow error")
                    break;
            }



            inputEmailRef.current.value = "";
            inputNameRef.current.value = "";
            inputPhoneRef.current.value = "";
            inputBirthdayRef.current.value = "";
            setValidated(false);

        } else {

            setValidated(true);
        }
    }

    return (
        <>
            {(backEndResp === "success") ? <AlertDismissible /> : ""}
            {(backEndResp === "user_exists") ? <AlertDismissibleExample /> : ""}

            <>
                <div class="container">


                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Register</div>
                                <div class="card-body">

                                    <Form class="form-horizontal" method="post" validated={validated} onSubmit={submitHandler} noValidate  >

                                        <Form.Group>
                                            <Form.Label>Your Name</Form.Label>
                                            <div class="cols-sm-10">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-user fa px-3" aria-hidden="true"></i></span>
                                                    <Form.Control
                                                        required
                                                        type="text"
                                                        placeholder="Name"
                                                        ref={inputNameRef}
                                                    />
                                                    <Form.Control.Feedback>Looks good!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>Your Email</Form.Label>

                                            <div class="cols-sm-10">
                                                <div class="input-group has-validation">
                                                    <span class="input-group-addon"><i class="fa fa-envelope  fa px-3" aria-hidden="true"></i></span>
                                                    <Form.Control
                                                        required
                                                        type="email"
                                                        name="email"
                                                        id="email"
                                                        placeholder="Email"
                                                        ref={inputEmailRef}
                                                    />
                                                    <Form.Control.Feedback>Looks good!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>Telephone</Form.Label>

                                            <div class="cols-sm-10">
                                                <div class="input-group has-validation">
                                                    <span class="input-group-addon"><i class="fa fa-phone fa px-3" aria-hidden="true"></i></span>
                                                    <Form.Control
                                                        required
                                                        type="number"
                                                        name="phone"
                                                        id="phone"
                                                        placeholder="Telephone"
                                                        ref={inputPhoneRef}
                                                    />
                                                    <Form.Control.Feedback>Looks good!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <Form.Label>Birthday</Form.Label>

                                            <div class="cols-sm-10">
                                                <div class="input-group has-validation">
                                                    <span class="input-group-addon"><i class="fa fa-link fa px-3" aria-hidden="true"></i></span>
                                                    <Form.Control
                                                        required
                                                        type="data"
                                                        name="birthday"
                                                        id="birthday"
                                                        placeholder="Birthday"
                                                        ref={inputBirthdayRef}
                                                    />
                                                    <Form.Control.Feedback>Looks good!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <div>
                                        </div>
                                        <br />
                                        <Form.Group>
                                            <Button type="submit">Submit form</Button>
                                        </Form.Group>

                                    </Form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </>

        </>
    )
}

export default Contact;