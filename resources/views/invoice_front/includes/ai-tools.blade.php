<section class="jsai-section">

    <div class="jsai-container">


        <!-- =================================================
             HEADER
        ================================================== -->

        <div class="jsai-header jsai-reveal">

            <div class="jsai-badge">

                <span class="jsai-badge-icon">
                    <i class="bi bi-stars"></i>
                </span>

                <span>EXPLORE WITH CONFIDENCE</span>

            </div>


            <h1 class="jsai-title">
                Ask AI About
                <span> JewelERP</span>
            </h1>


            <div class="jsai-description">
                {{ $aiToolsContent->ai_tools_title ?? 'Have questions about this solution? Explore how JewelERP can help your jewellery business with AI assistance or connect with our team for expert guidance.' }}
            </div>

        </div>



        <!-- =================================================
             PROMPT CARD
        ================================================== -->

        <div
            class="jsai-prompt jsai-reveal"
            style="--jsai-delay:.12s;"
        >

            <div class="jsai-prompt-content">

                <div id="jsaiPromptText">
                    {!! $aiToolsContent->ai_tools_content ?? "I'm evaluating JewelERP's Purchase Management solution for a jewellery business. Explain how it could help with unclear landed cost, receipt mismatches, vendor reconciliation delays, what workflows I should evaluate in a demo, and what questions I should ask the JewelERP team. Please use only public information and do not assume access to private JewelERP data." !!}
                </div>

            </div>


            <button
                type="button"
                class="jsai-copy-btn"
                id="jsaiCopyBtn"
            >

                <i class="bi bi-copy"></i>

                <span id="jsaiCopyText">
                    Copy prompt
                </span>

            </button>

        </div>



        <!-- =================================================
             SIX AI CARDS
             DESKTOP = ONE ROW
        ================================================== -->

        <div class="jsai-grid">


            <!-- CHATGPT -->

            <a
                href="https://chatgpt.com/"
                target="_blank"
                rel="noopener noreferrer"
                class="jsai-card jsai-reveal"
                style="--jsai-delay:.18s;"
            >

                <span class="jsai-card-glow"></span>

                <span class="jsai-card-shine"></span>


                <div class="jsai-card-icon">

                    <i class="bi bi-stars"></i>

                </div>


                <h3>
                    ChatGPT
                </h3>


                <span class="jsai-card-action">
                    ASK
                </span>


                <span class="jsai-card-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </span>

            </a>



            <!-- CLAUDE -->

            <a
                href="https://claude.ai/"
                target="_blank"
                rel="noopener noreferrer"
                class="jsai-card jsai-reveal"
                style="--jsai-delay:.24s;"
            >

                <span class="jsai-card-glow"></span>

                <span class="jsai-card-shine"></span>


                <div class="jsai-card-icon">

                    <i class="bi bi-stars"></i>

                </div>


                <h3>
                    Claude
                </h3>


                <span class="jsai-card-action">
                    ASK
                </span>


                <span class="jsai-card-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </span>

            </a>



            <!-- GEMINI -->

            <a
                href="https://gemini.google.com/app"
                target="_blank"
                rel="noopener noreferrer"
                class="jsai-card jsai-reveal"
                style="--jsai-delay:.30s;"
            >

                <span class="jsai-card-glow"></span>

                <span class="jsai-card-shine"></span>


                <div class="jsai-card-icon">

                    <i class="bi bi-gem"></i>

                </div>


                <h3>
                    Gemini
                </h3>


                <span class="jsai-card-action">
                    ASK
                </span>


                <span class="jsai-card-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </span>

            </a>



            <!-- PERPLEXITY -->

            <a
                href="https://www.perplexity.ai/"
                target="_blank"
                rel="noopener noreferrer"
                class="jsai-card jsai-reveal"
                style="--jsai-delay:.36s;"
            >

                <span class="jsai-card-glow"></span>

                <span class="jsai-card-shine"></span>


                <div class="jsai-card-icon">

                    <i class="bi bi-search"></i>

                </div>


                <h3>
                    Perplexity
                </h3>


                <span class="jsai-card-action">
                    SEARCH
                </span>


                <span class="jsai-card-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </span>

            </a>



            <!-- GROK -->

            <a
                href="https://grok.com/"
                target="_blank"
                rel="noopener noreferrer"
                class="jsai-card jsai-reveal"
                style="--jsai-delay:.42s;"
            >

                <span class="jsai-card-glow"></span>

                <span class="jsai-card-shine"></span>


                <div class="jsai-card-icon">

                    <i class="bi bi-lightning-charge"></i>

                </div>


                <h3>
                    Grok
                </h3>


                <span class="jsai-card-action">
                    ASK
                </span>


                <span class="jsai-card-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </span>

            </a>



            <!-- OUR TEAM -->

            <a
                href="{{ url('/help') }}"
                class="jsai-card jsai-reveal"
                style="--jsai-delay:.48s;"
            >

                <span class="jsai-card-glow"></span>

                <span class="jsai-card-shine"></span>


                <div class="jsai-card-icon">

                    <i class="bi bi-people"></i>

                </div>


                <h3>
                    Our Team
                </h3>


                <span class="jsai-card-action">
                    TALK
                </span>


                <span class="jsai-card-arrow">
                    <i class="bi bi-arrow-up-right"></i>
                </span>

            </a>


        </div>

    </div>

</section>