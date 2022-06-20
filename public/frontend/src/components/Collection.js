import { Col,Row,Container } from "react-bootstrap";
import nft from "../assets/images/portfolio.jpg"
import { Link } from "react-router-dom";
import Web3Modal from "web3modal";
import { ethers, BigNumber } from "ethers";
import { nft_addr } from "../contract/addresses";
import { useWeb3React } from "@web3-react/core";
import NFTAbi from "../contract/NFT.json"

function Collection(){

    const {
        connector,
        library,
        account,
        chainId,
        activate,
        deactivate,
        active,
        errorWeb3Modal,
        active: networkActive, error: networkError, activate: activateNetwork
      } = useWeb3React();

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

    const CreateToken = async (id) => {
        try {
            let signer = await loadProvider()
            let NFTSaleContract = new ethers.Contract(nft_addr, NFTAbi, signer)
            let createToken = await NFTSaleContract.createToken(account,id)
            await createToken.wait();
        }
        catch (e) {
            console.log("error: ", e)
        }
    }


    return(

        <>
        
           <Container className="pt-5">

                {/* <div className="section-title">
                    <h2>Collection</h2>
                </div> */}

                <Row className="my-5 justify-content-center">

                    <Col lg={2}>

                        <div className="collection-box blue">

                            <img src="https://ipfs.io/ipfs/QmeKmDkiR8TQ9vDctk6fHsmWtr2zz6eDXSf8AQF5Wk7k2q?filename=1421.jpg"/>
                            <h4>Viserion</h4>
                            <div className="text-center">

                                <button onClick={() => CreateToken(11)} className="btn-small">Mint</button>

                            </div>

                        </div>
                       

                    </Col>

                    {/* <Col lg={2}>

                    <div className="collection-box blue">

                        <img src={nft}/>
                        <h4>Crypto Jumbo</h4>
                        <div className="text-center">

                                <button className="btn-small">Mint</button>

                        </div>

                    </div>


                    </Col> */}

                    <Col lg={2}>

                    <div className="collection-box blue">

                        <img src={nft}/>
                        <h4>Crypto Jumbo</h4>
                        <div className="text-center">

                                <button className="btn-small">Mint</button>

                        </div>

                    </div>

                    </Col>

                    <Col lg={2}>

                    <div className="collection-box blue">

                        <img src={nft}/>
                        <h4>Crypto Punishment</h4>
                        <div className="text-center">

                                <button className="btn-small">Mint</button>

                        </div>

                    </div>

                    </Col>

                    <Col lg={2}>

                    <div className="collection-box blue">

                        <img src="https://ipfs.io/ipfs/QmWzHMFJKff9hSUv4Lnb9cb6xeFjhsSi8gATMzWMtcwT9t?filename=1543.jpg"/>
                        <h4>Crypto Cuack</h4>
                        <div className="text-center">

                        <button onClick={() => CreateToken(13)} className="btn-small">Mint</button>

                        </div>

                    </div>

                    </Col>

                    <Col lg={2}>

                    <div className="collection-box blue">

                        <img src={nft}/>
                        <h4>Bark Crypto Pug</h4>
                        <div className="text-center">

                                <button className="btn-small">Mint</button>

                        </div>

                    </div>

                    </Col>
    

                </Row>

                <Row className="mb-5 justify-content-center">
                    
                    <Col lg={2}>

                        <div className="collection-box yellow">

                            <img src="https://ipfs.io/ipfs/QmZQdQGRK71ehV9r2RgSgtGQRLDRJpyCurFako5SFau7Jz?filename=87.jpg"/>
                            <h4>SpeechLESS</h4>
                            <div className="text-center">

                            <button onClick={() => CreateToken(2)} className="btn-small">Mint</button>

                            </div>

                        </div>

                    </Col>

                    <Col lg={2}>

                    <div className="collection-box yellow">

                        <img src="https://ipfs.io/ipfs/QmeSgkSJauu713s6dXtQRLD1oL5tsAzJUqcPCw5nccna4T?filename=15.jpg"/>
                        <h4>BRAVETY</h4>
                        <div className="text-center">

                        <button onClick={() => CreateToken(1)} className="btn-small">Mint</button>

                        </div>

                    </div>

                    </Col>

                    <Col lg={2}>

                    <div className="collection-box yellow">

                        <img src={nft}/>
                        <h4>Always on My HEAD</h4>
                        <div className="text-center">

                                <button className="btn-small">Mint</button>

                        </div>

                    </div>

                    </Col>

                    <Col lg={2}>

                    <div className="collection-box yellow">

                        <img src={nft}/>
                        <h4>Caribbean Crypto Exotics</h4>
                        <div className="text-center">

                                <button className="btn-small">Mint</button>

                        </div>

                    </div>

                    </Col>


                </Row>

                <Row className="mb-5 justify-content-center">
                    
                    <Col lg={2}>

                        <div className="collection-box pink">

                            <img src={nft}/>
                            <h4>It never happened</h4>
                            <div className="text-center">

                                <button className="btn-small">Mint</button>

                            </div>

                        </div>

                    </Col>

                    <Col lg={2}>

                    <div className="collection-box pink">

                        <img src={nft}/>
                        <h4>Unoccupied</h4>
                        <div className="text-center">

                                <button className="btn-small">Mint</button>

                        </div>

                    </div>

                    </Col>

                    <Col lg={2}>

                    <div className="collection-box pink">

                        <img src={nft}/>
                        <h4>Bare SOLO Lights</h4>
                        <div className="text-center">

                                <button className="btn-small">Mint</button>

                        </div>

                    </div>

                    </Col>


                </Row>


                <Row className="mb-5 justify-content-center">
                    
                    <Col lg={2}>

                        <div className="collection-box green">

                            <img src={nft}/>
                            <h4>It never happened</h4>

                            <div className="text-center">

                            <button className="btn-small">Mint</button>

                            </div>

                        </div>

                    </Col>

                    <Col lg={2}>

                    <div className="collection-box green">

                        <img src={nft}/>
                        <h4>Unoccupied</h4>
                        <div className="text-center">

                            <button className="btn-small">Mint</button>

                            </div>

                    </div>

                    </Col>


                </Row>


                {/* <div className="d-flex justify-content-center p-5">
                    <Link to={"#"} className="custom-btn primary-btn">More</Link>
                </div> */}

           </Container>

        </>

    )

}

export default Collection;