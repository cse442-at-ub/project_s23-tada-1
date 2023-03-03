import { Box } from "@mui/material";
import React from "react";

export default function HelloWorld() {
    return (
        <Box
            className="hw-box"
            sx={{ backgroundColor: "#0ec454", color: "#b8ffd3" }}
        >
            <h1>Hello World!</h1>
        </Box>
    );
}
