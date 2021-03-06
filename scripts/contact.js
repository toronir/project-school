import React, { useRef, useState } from "react";

import { Button, Form, Alert, InputGroup } from "react-bootstrap";
import AlertDismissible from "./alertSuccess.js";
import AlertDismissibleExample from "./alertError.js";

const Contact = () => {
    const [typeI, setTypeI] = useState("text")
    const inputEmailRef = useRef();
    const inputFirstNameRef = useRef();
    const inputSecondNameRef = useRef();
    const inputPhoneRef = useRef();
    const inputBirthdayRef = useRef();
    const inputMassageRef = useRef();
    const inputFileRef = useRef(null);
    const [validated, setValidated] = useState(false);
    const [backEndResp, setBackEndResp] = useState("");
    const [successEmail, setSuccessEmail] = useState("");

    const submitHandler = async (event) => {
        event.preventDefault();
        const form = event.currentTarget;
        const email = inputEmailRef.current.value;
        const firstName = inputFirstNameRef.current.value;
        const secondName = inputSecondNameRef.current.value;
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
                body: JSON.stringify({ email: email, firstName: firstName, secondName: secondName, phone: phone, birthday: birthday, massage: massage, file: file })

            });


            const responseData = await response.json();
            console.log(responseData);

            switch (responseData) {
                case "success":
                    setBackEndResp("success")
                    break;
                case "user_exists":
                    setBackEndResp("user_exists")
                    break;
                // case "error":
                //     alert("Co?? posz??o nie tak")
                //     break;



                default:
                    alert("Unknow error")
                    break;
            }


            setSuccessEmail(inputEmailRef.current.value);
            inputEmailRef.current.value = "";
            inputFirstNameRef.current.value = "";
            inputSecondNameRef.current.value = "";
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


            <>
                {/* Form end  */}
                <div className="container ">

                    <div className="row justify-content-center">
                        <h2 className="textT">Zg??o?? si?? do Cat Army jednym klikni??ciem!</h2>
                        <h5 className="textT mb-5 text-center">
                            Wystarczy, ??e uzupelnisz wymagane pola i prze??lesz do nas swoje zg??oszenie, a my rozpatrzymy je w ci??gu 48h!
                            Po pozytywnym rozpatrzeniu Twojego formularza dostaniesz maila z has??em do swojego konta.
                            I to wszystko! Od tej pory mo??esz cieszy?? si?? pe??nym dost??pem do serwisu.</h5>
                        <br />
                        <div className="col-md-8">
                            {(backEndResp === "success") ? <AlertDismissible user_mail={successEmail} /> : ""}
                            {(backEndResp === "user_exists") ? <AlertDismissibleExample /> : ""}
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
                                                        className="custom-form-control "
                                                        required
                                                        type="text"
                                                        placeholder="Imi??..."
                                                        ref={inputFirstNameRef}
                                                    />
                                                    <Form.Control.Feedback>Wygl??da dobrze!</Form.Control.Feedback>
                                                </div>

                                            </div>
                                        </Form.Group>

                                        <Form.Group>
                                            <div className="cols-sm-10 mb-3 ">
                                                <div className="input-group">
                                                    <InputGroup.Text id="basic-addon1"><span className="input-group-addon">
                                                        <i className="fa fa-user fa px-3 form-control-icon" aria-hidden="true"></i>
                                                    </span></InputGroup.Text>
                                                    <Form.Control
                                                        className="custom-form-control "
                                                        required
                                                        type="text"
                                                        placeholder="Nazwisko..."
                                                        ref={inputSecondNameRef}
                                                    />
                                                    <Form.Control.Feedback>Wygl??da dobrze!</Form.Control.Feedback>
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
                                                        placeholder="Tw??j email..."
                                                        ref={inputEmailRef}
                                                    />
                                                    <Form.Control.Feedback>Wygl??da dobrze!</Form.Control.Feedback>
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
                                                        placeholder="Tw??j telefon..."
                                                        ref={inputPhoneRef}
                                                    />
                                                    <Form.Control.Feedback>Wygl??da dobrze!</Form.Control.Feedback>
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
                                                        type={typeI}
                                                        onFocus={() => { setTypeI("date") }}

                                                        name="birthday"
                                                        id="birthday"
                                                        placeholder="Data urodzenia..."
                                                        ref={inputBirthdayRef}
                                                    />
                                                    <Form.Control.Feedback>Wygl??da dobrze!</Form.Control.Feedback>
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
                                                        ref={inputMassageRef}
                                                    />
                                                    <Form.Control.Feedback>Wygl??da dobrze!</Form.Control.Feedback>
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <div className=" col-sm-10 col-lg-4 mb-3 ">
                                                <div className="input-group ">


                                                    <Form.Control
                                                        className="custom-file-input p-0"
                                                        accept=".pdf"
                                                        type="file"
                                                        name="file"
                                                        id="fileUpload"
                                                        placeholder="Plik PDF"
                                                        ref={inputFileRef}
                                                    />



                                                </div>
                                            </div>
                                        </Form.Group>
                                        <Form.Group>
                                            <div className="  ">
                                                <div className="input-group has-validation ">

                                                    <Form.Check
                                                        required
                                                        type="checkbox"
                                                        id="custom-checkbox"
                                                        className="custom-checkbox"
                                                        label="Wyra??am zgod?? na przetwarzanie moich danych w celach marketingowych i na wysy??k?? materia????w promocyjnych"
                                                    />

                                                    <Form.Control.Feedback>Wygl??da dobrze!</Form.Control.Feedback>




                            
                                                </div>
                                            </div>
                                        </Form.Group>
                                        <div>
                                        </div>
                                        <br />

                                        <Form.Group >
                                            <button type="submit" className="btn-gold-primary">Wy??lij</button>
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