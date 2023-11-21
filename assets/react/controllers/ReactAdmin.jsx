import { HydraAdmin } from "@api-platform/admin";
import React from 'react';

// Replace with your own API entrypoint
// For instance if https://example.com/api/books is the path to the collection of book resources, then the entrypoint is https://example.com/api
export default (props) => (
    <HydraAdmin entrypoint={props.entrypoint} />
);