import React from "react";
import { createRoot } from "react-dom/client";

import HelloWorld from "./components/HelloWorld";

import "../scss/app.scss";

export default function Main() {
    return (
        <div className="content">
            <HelloWorld />
        </div>
    );
}

if (document.getElementById("main")) {
    const root = createRoot(document.getElementById("main"));
    root.render(<Main />);
    // ReactDOM.render(<Main />, document.getElementById("main"));
}
