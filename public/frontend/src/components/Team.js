import { Col,Row,Container } from "react-bootstrap";
import team from "../assets/images/portfolio.jpg"

function Team(){

    return(

        <>
        
        <Container className="d-none">

        <div className="section-title">
            <h2>Team</h2>
        </div>

        <Row className="mt-5 py-5">
            <Col lg={3}>

                <div className="team-box">

                    <img src={team}/>

                    <div>
                        <h4>
                            Team 1
                        </h4>
                        <p>Developer</p>
                    </div>

                </div>

            </Col>

            <Col lg={3}>

            <div className="team-box">

                <img src={team}/>

                <div>
                    <h4>
                        Team 2
                    </h4>
                    <p>Developer</p>
                </div>

            </div>

            </Col>

            <Col lg={3}>

            <div className="team-box">

                <img src={team}/>

                <div>
                    <h4>
                        Team 3
                    </h4>
                    <p>Developer</p>
                </div>

            </div>

            </Col>

            <Col lg={3}>

            <div className="team-box">

                <img src={team}/>

                <div>
                    <h4>
                        Team 4
                    </h4>
                    <p>Developer</p>
                </div>

            </div>

            </Col>
        </Row>

        </Container>

        </>

    )

}

export default Team;