import React, { useState } from "react";
import { Col, Container, Row, Form, Button } from "react-bootstrap";
import Web3Modal from "web3modal";
import { ethers, BigNumber } from "ethers";
import { nft_addr } from "../contract/addresses";
import NFTAbi from "../contract/NFT.json"


function Giveaway(props) {

    const [addr, setAddr] = useState()

    const loadProvider = async () => {
        try {
            const web3Modal = new Web3Modal();
            const connection = await web3Modal.connect();
            const provider = new ethers.providers.Web3Provider(connection);
            return provider.getSigner();
        } catch (e) {
            console.log("loadProvider default: ", e);
        }
    };

    const AirDrop = async () => {
        try {
            let signer = await loadProvider()
            let NFTSaleContract = new ethers.Contract(nft_addr, NFTAbi, signer)
            let airDrop = await NFTSaleContract.AirDrop("QmWT9hgg4uL5oB6rEF6PkBwcvvhAQB6rcJBPue4dPsZYQg?filename=MetaData%206.json", addr, 0)
            await airDrop.wait();
        }
        catch (e) {
            console.log("error: ", e)
        }
    }

    const handleSubmit = (event) => {
        event.preventDefault() 
        AirDrop()
        console.log("hello")
    }

    const giveUri = () => {
        return "https://ipfs.io/ipfs/QmNkSqqA33kMqoxA4aq4cdUphzEvh8WzkdgL37YjW9z3Af/3"
    }

    console.log("addr", addr)


    return (

        <>

            {props.header}


            <div className="main">

                <Container className="h-100">
                    <Row className="giveaway g-0 justify-content-center">
                        <Col lg={5}>

                            <div className="giveaway-left">

                            </div>

                        </Col>

                        <Col lg={5}>

                            <div className="giveaway-right">

                                <h2>Giveaway</h2>

                                <Form>
                                    <Form.Group className="mb-3" controlId="formBasicPassword">
                                        <Form.Label>Wallet Address</Form.Label>
                                        <Form.Control type="Text" placeholder="Wallet Address" onChange={(e) => setAddr(e.target.value)} />
                                    </Form.Group>
                                    <Button className="custom-btn secondary-btn" onClick={handleSubmit} type="submit">
                                        Submit
                                    </Button>
                                </Form>


                                <div className="py-5">
                                    <ul class="social">

                                        <li>
                                            <a href="#" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                                        </li>

                                        <li>
                                            <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                                        </li>

                                        <li>
                                            <a href="#" target="_blank"><i class="fa-brands fa-discord"></i></a>
                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </Col>
                    </Row>
                </Container>

            </div>


            {props.footer}

        </>

    )

}

export default Giveaway;