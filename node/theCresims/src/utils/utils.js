export const reduceEnergy = (cresim, amount) => {
    if (cresim.energy - amount < 0) {
        return false;
    }
    const newCresim = {
        ...cresim,
        energy: cresim.energy - amount
    }
    return newCresim;
};

// New Code