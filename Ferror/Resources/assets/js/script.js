window.addEventListener("load", () => {

    function unActiveMenuItem(target) {
        if (target == "all") {
            menuItem.forEach((element) => {
                element.classList.remove("active");
            });
        }
    }

    function unActiveMenuTitle(target) {
        if (target == "all") {
            menuTitles.forEach((element) => {
                element.classList.remove("activeTitleMenu");
            });
        } else {
            target.classList.remove("activeTitleMenu");
        }
    }

    EnlighterJS.init('pre', 'code');

    const menuItem = document.querySelectorAll(".menu ul li");
    const codeBlocks = document.querySelectorAll(".codeBlock");
    const menuTitles = document.querySelectorAll(".menu ul div.menuSubTitle");
    const globalParagraphe = document.getElementById("globalParagraphe");
    const errorMessage = document.querySelector(".iconBloc");
    const copySpan = document.querySelector("#copySpan");
    

    // Copy Message to clipboard
    errorMessage.addEventListener("click", () => {
        const copyTextarea = document.getElementById('errorMessage');
        copyTextarea.focus();
        copyTextarea.select();
        document.execCommand('copy');
        copySpan.textContent = "copied";

        setTimeout(() => {
            copySpan.textContent = "copy";
        }, 1000);
    })

    // Auto select Menu item [File] 
    globalParagraphe.addEventListener("click", () => {
        menuItem[3].click();
    })

    // Update Menu item UI when select one of them
    menuItem.forEach((list) => {
        list.addEventListener("click", () => {
            // Unactive all element before procedd
            unActiveMenuItem("all");

            // hide All element
            codeBlocks.forEach((codeBlock) => {
                codeBlock.classList.replace("visible", "invisible");
            })

            // Active target menu
            list.classList.add("active");
            // load target Data;
            let el = document.querySelector(".codeBlock[data-globals='" + list.dataset.targetGlobal + "']");
            el.classList.replace("invisible", "visible");
        })
    });
    menuTitles.forEach((menuTitle) => {
        menuTitle.addEventListener("click", () => {
            unActiveMenuTitle("all");
            menuTitle.classList.add("activeTitleMenu");
        })
    })
})