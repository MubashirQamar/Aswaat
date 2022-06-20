import { Container,Row,Col } from "react-bootstrap";
import portfolio from "../assets/images/portfolio.jpg"
import yuliia from "../assets/images/yuliia.png"


function About(props){

    return(

        <>
        
        {props.header}

        <div className="main">

            <section className="about-section">

                <Container>

                    <Row>

                        <Col lg={4}>

                        <div className="collection-box pink">
                            
                            <img src={portfolio} className="animate"/>

                        </div>

                        </Col>

                        <Col lg={8}>

                        <div className="dual-heading">
                            <h3>About Us</h3>
                            
                        </div>

                        <p className="about-p">I am Jarlath (artistic name) and this is our story.
                        <br/>
                            I am from the Caribbean. During the last 3 years I realized how resilient I am and how strong I was born and raised to overcome the unforeseen. 
                              
                            <br/>
                            <br/>

                            I am a publicist who graduated in 2012. By 2014 I got a master’s degree in Executive Project Management and have been working in that field since 2005.

                            <br/>
                            <br/>

                            I always had a hard time saving money; like the drug addicts I have no interest in money: if needed, I would spend it: I have been rich and I have been poor, so I know a little of both worlds. Just before the pandemic kicked in, I started acquiring small pieces of different Cryptocurrencies and later I realized that this was my escape plan to little savings. Today, as if the pandemic isn't enough, it feels like the world is falling apart: war, a lot of people suffering, many others dying, hunger, climate change, and inflation. In the NFT world I have found means to vent my sorrow, my thoughts, my anger, my fears, my frustration, my pain.

                            <br/>
                            <br/>

                            Jarlath Art is more than art, it is my life in various sizes, figures, colors and shapes. It is also a multi-culture reality. Slowly I have gathered the right team of people that can express with their creativity what I cannot say with words and also vent themselves out to the world. I have a team of a Community Manager (The Caribbean), a Discord Moderator (The Philippines), and A Creative & Graphic Designer (Ukraine)
                            who is my biggest motivation. We started without any budget and no investor, just a little piece of a broken heart inside each one of us that together, forms a whole.

                            <br/>
                            <br/>

                            3.5% of the profits of our collections will be used to sponsor our Stellar Designer & Creative so she can start a new life with her children far from the war. We will sponsor The Jarlath Team. Our artists are highly talented people but with no funds to develop their careers. When we succeed, I also would like to adopt or sponsor children from one of the countries (Ukraine)
                             that, as of now, is struggling to go through this crazy world and its madness in one piece.


                        </p>

                        </Col>
                    </Row>

                </Container>

            </section>

            <Container className="pb-5">

                <Row className="gy-5" >

                    <Col lg={4}> 
 
                    <div className="collection-box ukrain">
                        
                        <img src={yuliia} className="animate"/>
                        <p>#wesupportUkraine</p>

                    </div>

                    </Col>

                    <Col lg={8}>

                        <div class="section-title">
                            <h3>The Creative & Designer - Yuliia (Ukraine)</h3>
                        </div>

                        <p className="about-p">"I am a self-taught artist. I started drawing as a child. I copied characters from my mother's books, movies and school newspapers. I couldn't get into the Art Institute because it was believed that the artist is not a profession, and it is impossible to make money out of drawing. That was the stereotype, but I continued drawing. As a barista, I used espresso instead of paint and created coffee pictures. On my second maternity leave with my newborn, I took digital illustration without knowing that one day I would live off that. I am from an ordinary poor family, so I could only take a drawing tablet on credit for 2 years. I drew a lot: for my friends and for my acquaintances (for FREE), then for advertising with bloggers and later, I had a successful cooperation with a Fashion Designer, an online game, and private orders. Due to Improper marketing, I received too few offers, so I had to go back to offline earnings. I was saving money for a small vacation with my family and then, the war came. We are hiding from the bombing in the cellar and the money is about to be gone. This is when I had a cold thought and went online, remembered the accounts that I once created as a freelancer and started knocking at doors. I sent a lot of cover letters, applied to several job postings and after so many tries and almost feeling hopeless, I received my first offer and there aren't enough words that can describe how happy and blessed I am. When the war is over, I will be able to go after my passion and show my children the world."</p>

                    </Col>

                    <Col lg={6}>

                        <div class="section-title">
                            <h3>The Discord Moderator - McPaul (The Philippines) </h3>
                            <p className="about-p">
                            "Being a Community Manager/Moderator has been my passion since I was a kid. I was a gamer: FPS games, RPG games, computer games. In every game I played when I was young, there was always a Moderator, and I was curious about their job: they were just playing AND getting paid. I knew that when the right time comes, I would be a Moderator. Today, this is a blessing for me and for my family; I started working from home before the pandemic started and remote work became popular. I can do my work from anywhere and at any time. I have met great people, I have grown in the Crypto world, I have gained the trust of my NFT owners and the respect of my colleagues. Before I jumped into the Freelancing universe, I was a Network Engineer where I was getting a fair wage, but I was feeling something was missing. My wife saw this first job and pushed me into it. I was still a full-time employee, and I was afraid. Then, my hard work started to show fruits and one offer after the other knocked at my door. A lot of different experiences has brought me to this day in which after so many losses and many other gains, I keep investing in Crypto, this is what I do for a living, to support my family. A couple of months ago, while being a Moderator with another 3 guys, one of them got his account (that was linked to OpenSea and the wallet and so on) hacked and +4.2MM in NFT were stolen. I also have great stories to share, but of those, everybody has one".
                            </p>
                        </div>

                    </Col>

                    <Col lg={6}>

                        <div class="section-title">
                            <h3>The Community Manager</h3>
                            <p className="about-p">
                            “I am 24 years old. Last year I started to get interested in crypto and NFT's. Later I started investigating, reading, watching videos and taking online courses. Since that moment my life has changed. In my country, we have too few job opportunities and I needed money to support my family. A lot of bad things have happened to me and my family lately, so I decided to look for a remote job so I can help them out. I was navigating on the internet and saw the opportunity to work on this project and I applied to it with no hope left. I thought that it was impossible because I don't have a lot of experience, but my application was responded to and I was so excited I couldn't believe it. Finally someone gave me the chance to work with a real team. My expectations for this would be to provide a work environment in which I can contribute to the team, I receive appreciation for my contributions, I have job stability and the ability to grow with this amazing team. I couldn't be more happy and grateful to be part of this project.”
                            </p>
                        </div>

                    </Col>
                </Row>


            </Container>

        </div>

        {props.footer}

        </>

    )

}

export default About;