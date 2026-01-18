import React, { useState, useEffect } from 'react'
import { motion, AnimatePresence, Transition } from 'framer-motion'

interface RotatingTextProps {
    texts: string[]
    mainClassName?: string
    initial?: any
    animate?: any
    exit?: any
    staggerDuration?: number
    splitLevelClassName?: string
    transition?: Transition
    rotationInterval?: number
}

const RotatingText: React.FC<RotatingTextProps> = ({
    texts,
    mainClassName = '',
    initial = { y: '100%' },
    animate = { y: 0 },
    exit = { y: '-120%' },
    staggerDuration = 0.025,
    splitLevelClassName = '',
    transition = { type: 'spring', damping: 30, stiffness: 400 },
    rotationInterval = 2000,
}) => {
    const [index, setIndex] = useState(0)

    useEffect(() => {
        const timer = setInterval(() => {
            setIndex((prev) => (prev + 1) % texts.length)
        }, rotationInterval)
        return () => clearInterval(timer)
    }, [texts.length, rotationInterval])

    return (
        <div className={`relative inline-flex ${mainClassName}`}>
            <AnimatePresence mode="wait">
                <motion.div
                    key={index}
                    className={`flex ${splitLevelClassName}`}
                    initial="initial"
                    animate="animate"
                    exit="exit"
                >
                    {texts[index].split('').map((char, i) => (
                        <motion.span
                            key={i}
                            variants={{
                                initial: initial,
                                animate: animate,
                                exit: exit,
                            }}
                            transition={{
                                ...transition,
                                delay: i * staggerDuration,
                            }}
                            style={{ display: 'inline-block', whiteSpace: 'pre' }}
                        >
                            {char}
                        </motion.span>
                    ))}
                </motion.div>
            </AnimatePresence>
        </div>
    )
}

export default RotatingText
