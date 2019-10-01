
function roundTo(to, number) {
    return (Math.ceil(number) % to === 0) ? Math.ceil(number) : Math.round((number + to / 2) / to) * to
}

export default roundTo
