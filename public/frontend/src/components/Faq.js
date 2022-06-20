import { Container, Accordion } from "react-bootstrap";

function Faq(props){

    return(

        <>
                {props.header}

        <div className={`${props.header!=null ? "main" : ""}`}> 
        <Container >

            <div className="section-title">
                <h2>FAQ</h2>
            </div>

            <Accordion defaultActiveKey="0" flush className="py-5">
                <Accordion.Item eventKey="0">
                    <Accordion.Header>What is an NFT? Is it a cryptocurrency?</Accordion.Header>
                    <Accordion.Body>
                    Non-Fungible Tokens are unique, easily verifiable digital assets that can represent items such as GIFs, images, videos, music albums, and more. Anything that exists online can be purchased as an NFT, theoretically. 
                    NFTs are different from cryptocurrencies because they’re not interchangeable.

                    </Accordion.Body>
                </Accordion.Item>
                <Accordion.Item eventKey="1">
                    <Accordion.Header>Why would you want to own an NFT? Can you make money on it?</Accordion.Header>
                    <Accordion.Body>
                    One reason to buy an NFT is for its emotional value, which isn’t so different from physical objects. No one buys a pair of glasses because they need it. They buy it for the way it makes them feel. The same can be true for a GIF, image, video, or other digital asset. <nr/>
                    The other reason is because you think it’s valuable...and will only increase in value. And yes, you can make money off of an NFT by buying and reselling it for more.
                    </Accordion.Body>
                </Accordion.Item>
                <Accordion.Item eventKey="2">
                    <Accordion.Header>How do you buy an NFT?</Accordion.Header>
                    <Accordion.Body>
                    You register to join a waitlist that can be thousands of fans long. When a digital asset goes on sale, you’re randomly chosen to buy it. 
                    </Accordion.Body>
                </Accordion.Item>
                <Accordion.Item eventKey="3">
                    <Accordion.Header>How do you know our NFT is authentic?</Accordion.Header>
                    <Accordion.Body>
                    NFT ownership is recorded on the blockchain, and that entry acts as a digital slip. Tokens can be scanned to confirm their authenticity. 
                    </Accordion.Body>
                </Accordion.Item>
                <Accordion.Item eventKey="4">
                    <Accordion.Header>Why should you buy our NFTs?</Accordion.Header>
                    <Accordion.Body>
                    1. Our Collection are unique because is not a copy of any other digital asset, instead is an outcome of my request mixed with the creativity of a Marketer, a Publicist and 2 different designers the have never seen each other, lives in differents countries/continents and have a completely different approach. <nr/>
                    2. A share of our profits from our sales will be allocated to our Creative & Designer from Ukraine, 20% of the profit will be used to sponsor the team, if enough, children will be adopted or their education sponsored.
                    </Accordion.Body>
                </Accordion.Item>
            </Accordion>

        </Container>

        </div>
        {props.footer} 

        </>

    )

}

export default Faq;