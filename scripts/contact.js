import React, { useRef, useState } from "react";

import { Button, Form, Alert, InputGroup } from "react-bootstrap";
import AlertDismissible from "./alertSuccess.js";
import AlertDismissibleExample from "./alertError.js";
<<<<<<< Updated upstream
=======

>>>>>>> Stashed changes


const Contact = () => {
    const inputEmailRef = useRef();
    const inputNameRef = useRef();
    const inputPhoneRef = useRef();
    const inputBirthdayRef = useRef();
    const inputMassageRef = useRef();
    const inputFileRef = useRef();
    const [validated, setValidated] = useState(false);
    const [backEndResp, setBackEndResp] = useState("");

    const submitHandler = async (event) => {
        event.preventDefault();
        const form = event.currentTarget;

        const email = inputEmailRef.current.value;
        const name = inputNameRef.current.value;
        const phone = inputPhoneRef.current.value;
        const birthday = inputBirthdayRef.current.value;
        const massage = inputMassageRef.current.value;
        const file = inputFileRef.current.value;

        console.log(form.checkValidity());
        console.log(file);
        if (email && form.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();


            const response = await fetch(`${page.api_url}work-on/contact`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ email: email, name: name, phone: phone, birthday: birthday, massage: massage, file: file })

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
            inputMassageRef.current.value = "";
            inputFileRef.current.value = "";

            setValidated(false);

        } else {

            setValidated(true);
        }
    }

    return (
        <>
            {/* Add error or success alerts */}
            {(backEndResp === "success") ? <AlertDismissible /> : ""}
            {(backEndResp === "user_exists") ? <AlertDismissibleExample /> : ""}

            <>
                {/* Form end  */}
                <div className="container ">
                    <div className="row justify-content-center">
                        <div className="col-md-8">
                            <div className="card">
                                <h3 className="card-header align-self-center mt-3">Rejestracja</h3>
                                <div className="card-body">
                                    <Form className="form-horizontal m-4" method="post" validated={validated} onSubmit={submitHandler} noValidate  >
                                        <Form.Group>
                                            <div className="cols-sm-10 mb-3 ">
                                                <div className="input-group">
                                                    <InputGroup.Text id="basic-addon1"><span className="input-group-addon">
                                                        <i className="fa fa-user fa px-3 form-control-icon" aria-hidden="true"></i>
                                                    </span></InputGroup.Text>
                                                    <Form.Control
                                                        className="custom-form-control"
                                                        required
                                                        type="text"
                                                        placeholder="Imię i Nazwisko..."
                                                        ref={inputNameRef}
                                                    />

                                                    <Form.Control.Feedback>Wygląda dobrze!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <div className="cols-sm-10 mb-3 ">
                                                <div className="input-group has-validation">
                                                    <InputGroup.Text id="basic-addon1">
                                                        <span className="input-group-addon"><i className="fa fa-envelope  fa px-3" aria-hidden="true"></i></span>
                                                    </InputGroup.Text>
                                                    <Form.Control
                                                        className="custom-form-control"
                                                        required
                                                        type="email"
                                                        name="email"
                                                        id="email"
                                                        placeholder="Twój email..."
                                                        ref={inputEmailRef}
                                                    />
                                                    <Form.Control.Feedback>Wygląda dobrze!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <div className="cols-sm-10 mb-3 ">
                                                <div className="input-group has-validation">
                                                    <InputGroup.Text id="basic-addon1">
                                                        <span className="input-group-addon"><i className="fa fa-phone fa px-3" aria-hidden="true"></i></span>
                                                    </InputGroup.Text>
                                                    <Form.Control
                                                        className="custom-form-control"
                                                        required
                                                        type="tel"
                                                        name="phone"
                                                        id="phone"
                                                        placeholder="Twój telefon..."
                                                        ref={inputPhoneRef}
                                                    />
                                                    <Form.Control.Feedback>Wygląda dobrze!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <div className="cols-sm-10 mb-3 ">
                                                <div className="input-group has-validation">
                                                    <InputGroup.Text id="basic-addon1"><span className="input-group-addon">
                                                        <i className="fa fa-link fa px-3" aria-hidden="true"></i>
                                                    </span></InputGroup.Text>
                                                    <Form.Control
                                                        className="custom-form-control off-style"
                                                        required
                                                        type="date"
                                                        name="birthday"
                                                        id="birthday"
                                                        placeholder="Data urodzenia..."
                                                        ref={inputMassageRef}
                                                    />
                                                    <Form.Control.Feedback>Wygląda dobrze!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <div className="cols-sm-10 mb-3 ">
                                                <div className="input-group has-validation">
                                                    <Form.Control
                                                        required
                                                        as="textarea"
                                                        name="massage"
                                                        id="massage"
                                                        placeholder="Napisz o sobie..."
                                                        rows={5}
                                                        ref={inputBirthdayRef}
                                                    />
                                                    <Form.Control.Feedback>Wygląda dobrze!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <div className=" col-sm-10 col-lg-4 mb-3 ">
                                                <div className="input-group has-validation">
                                                        <Form.Control

                                                            accept=".pdf"
                                                            type="file"
                                                            name="file"
                                                            id="file"
                                                            placeholder="Plik PDF"
                                                            ref={inputFileRef}
                                                        />
                                                        <Form.Control.Feedback>Wygląda dobrze!</Form.Control.Feedback>

                                                </div>
                                            </div>
                                        </Form.Group>
                                        <div>
                                        </div>
                                        <br />

                                        <Form.Group >
                                            <Button type="submit" className="btn-gold-primary">Wysłać</Button>
                                        </Form.Group>

                                    </Form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                {/* Form end */}
            </>

        </>
    )
}

export default Contact;